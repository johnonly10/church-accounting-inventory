<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as DomPdf;



class ExpenseReportController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('type')->orderBy('code')->get();

        $expenses = $this->expenseQuery($request)->get();

        return view('staff.expense-reports.index', compact('categories', 'expenses'));
    }

    public function pdf(Request $request)
    {
        $categories = Category::orderBy('type')->orderBy('code')->get();

        $expenses = $this->expenseQuery($request)->get();

        $grandTotal = (int) $expenses->sum('amount');

        $selectedCategory = null;
        if ($request->filled('category_id')) {
            $selectedCategory = $categories->firstWhere('id', (int) $request->category_id);
        }

        $dateFromLabel = $request->filled('date_from')
            ? Carbon::parse($request->date_from)->format('F j, Y')
            : 'N/A';

        $dateToLabel = $request->filled('date_to')
            ? Carbon::parse($request->date_to)->format('F j, Y')
            : 'N/A';

        $generatedAt = Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y, g:i a');

        // $user = auth()->user();

        $data = [
            'expenses'         => $expenses,
            'grandTotal'       => $grandTotal,
            'selectedCategory' => $selectedCategory,
            'dateFromLabel'    => $dateFromLabel,
            'dateToLabel'      => $dateToLabel,
            'generatedAt'      => $generatedAt,
            // 'preparedByName'   => strtoupper($user?->name ?? ''),
            // 'preparedByPos'    => $user?->position?->name ?? '',
        ];

        $pdf = DomPdf::loadView('staff.expense-reports.pdf', $data)->setPaper('a4', 'portrait');

        $filename = 'expense-reports_' . Carbon::now()->format('Y-m-d_His') . '.pdf';

        return $request->boolean('download')
            ? $pdf->download($filename)
            : $pdf->stream($filename);
    }

    private function expenseQuery(Request $request)
    {
        $query = Expense::query()
            ->with('category')
            ->orderBy('date', 'desc');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $from = $request->date_from;
            $to = $request->date_to;

            if ($from > $to) {
                [$from, $to] = [$to, $from];
            }

            $query->whereBetween('date', [$from, $to]);
        } elseif ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        return $query;
    }
}
