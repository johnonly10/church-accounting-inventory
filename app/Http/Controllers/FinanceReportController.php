<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FinanceReportController extends Controller
{
    public function index(Request $request)
    {
        // Get all finance records (revenues and expenses combined)
        $financeRecords = $this->getFinanceRecords($request);

        // Calculate totals
        $totalRevenue = $financeRecords->where('type', 'revenue')->sum('amount');
        $totalExpense = $financeRecords->where('type', 'expense')->sum('amount');
        $netIncome = $totalRevenue - $totalExpense;

        return view('staff.reports.finance.index', compact(
            'financeRecords',
            'totalRevenue',
            'totalExpense',
            'netIncome'
        ));
    }

    private function getFinanceRecords(Request $request)
    {
        // Get revenues
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
                'revenues.amount'
            );

        // Get expenses
        $expensesQuery = Expense::query()
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select(
                DB::raw("'expense' as type"),
                'expenses.id',
                'expenses.date',
                DB::raw("CONCAT_WS(' - ', expenses.name, expenses.description) as details"),
                DB::raw("CONCAT(categories.code, ' - ', categories.name) as category"),
                'expenses.paid as payment_method',
                'expenses.amount'
            );

        // Apply date filters
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

        // Apply payment method filter
        if ($request->filled('payment_method')) {
            $revenuesQuery->where('revenues.payment_method', $request->payment_method);
            $expensesQuery->where('expenses.paid', $request->payment_method);
        }

        // Combine queries using union
        $combined = $revenuesQuery
            ->union($expensesQuery)
            ->get()
            ->sortByDesc('date')
            ->values();

        return $combined;
    }
}
