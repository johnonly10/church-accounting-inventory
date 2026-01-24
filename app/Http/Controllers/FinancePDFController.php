<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\Expense;
use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as DomPdf;
use Carbon\Carbon;

class FinancePDFController extends Controller
{
    public function index(Request $request)
    {
        $financeRecords = $this->getFinanceRecords($request);

        $totalRevenue = $financeRecords->where('type', 'revenue')->sum('amount');
        $totalExpense = $financeRecords->where('type', 'expense')->sum('amount');
        $netIncome = $totalRevenue - $totalExpense;

        $dateFromLabel = $request->filled('date_from')
            ? Carbon::parse($request->date_from)->format('F j, Y')
            : 'N/A';

        $dateToLabel = $request->filled('date_to')
            ? Carbon::parse($request->date_to)->format('F j, Y')
            : 'N/A';

        $generatedAt = Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y, g:i a');

        $selectedPaymentMethod = $request->filled('payment_method') ? $request->payment_method : null;
        $paymentMethodLabels = [
            'online' => 'Online',
            'cash' => 'Cash',
            '' => 'All Methods'
        ];
        $paymentMethodLabel = $paymentMethodLabels[$selectedPaymentMethod] ?? 'All Methods';

        $signatures = Signature::with('position')
            ->where('is_active', true)
            ->get();

        $data = [
            'financeRecords' => $financeRecords,
            'totalRevenue' => $totalRevenue,
            'totalExpense' => $totalExpense,
            'netIncome' => $netIncome,
            'dateFromLabel' => $dateFromLabel,
            'dateToLabel' => $dateToLabel,
            'generatedAt' => $generatedAt,
            'selectedPaymentMethod' => $selectedPaymentMethod,
            'paymentMethodLabel' => $paymentMethodLabel,
            'signatures' => $signatures,
        ];

        $pdf = DomPdf::loadView('staff.pdf.finance.index', $data)->setPaper('a4', 'portrait');

        $filename = 'finance-report_' . Carbon::now()->format('Y-m-d_His') . '.pdf';

        return $request->boolean('download')
            ? $pdf->download($filename)
            : $pdf->stream($filename);
    }

    private function getFinanceRecords(Request $request)
    {
        $revenuesQuery = Revenue::query()
            ->join('revenue_collections', 'revenues.revenue_collection_id', '=', 'revenue_collections.id')
            ->join('revenue_types', 'revenues.revenue_type_id', '=', 'revenue_types.id')
            ->select(
                DB::raw("'revenue' as type"),
                'revenues.id',
                'revenue_collections.collection_date as date',
                'revenues.name as details',
                'revenue_types.name as category',
                'revenues.payment_method',
                'revenues.amount',
                'revenues.beneficiary'
            );

        $expensesQuery = Expense::query()
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select(
                DB::raw("'expense' as type"),
                'expenses.id',
                'expenses.date',
                DB::raw("CASE 
                    WHEN expenses.name IS NOT NULL AND expenses.description IS NOT NULL 
                    THEN CONCAT(expenses.name, ' - ', expenses.description)
                    WHEN expenses.name IS NOT NULL 
                    THEN expenses.name
                    WHEN expenses.description IS NOT NULL 
                    THEN expenses.description
                    ELSE '—'
                END as details"),
                DB::raw("CONCAT(categories.code, ' - ', categories.name) as category"),
                'expenses.paid as payment_method',
                'expenses.amount',
                DB::raw("NULL as beneficiary")
            );

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $from = $request->date_from;
            $to = $request->date_to;

            if ($from > $to) {
                [$from, $to] = [$to, $from];
            }

            $revenuesQuery->whereDate('revenue_collections.collection_date', '>=', $from)
                ->whereDate('revenue_collections.collection_date', '<=', $to);
            $expensesQuery->whereBetween('expenses.date', [$from, $to]);
        } elseif ($request->filled('date_from')) {
            $revenuesQuery->whereDate('revenue_collections.collection_date', '>=', $request->date_from);
            $expensesQuery->whereDate('expenses.date', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $revenuesQuery->whereDate('revenue_collections.collection_date', '<=', $request->date_to);
            $expensesQuery->whereDate('expenses.date', '<=', $request->date_to);
        }

        if ($request->filled('payment_method')) {
            $revenuesQuery->where('revenues.payment_method', $request->payment_method);
            $expensesQuery->where('expenses.paid', $request->payment_method);
        }

        $combined = $revenuesQuery
            ->union($expensesQuery)
            ->get()
            ->sortByDesc('date')
            ->values();

        return $combined;
    }
}
