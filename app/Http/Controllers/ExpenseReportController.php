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

        return view('staff.reports.expenses.index', compact('categories', 'expenses'));
    }

    private function expenseQuery(Request $request)
    {
        $query = Expense::query()
            ->with('category')
            ->orderBy('date', 'desc');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('paid')) {
            $query->where('paid', $request->paid);
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $from = $request->date_from;
            $to = $request->date_to;

            if ($from > $to) {
                [$from, $to] = [$to, $from];
            }

            $query->whereDate('date', [$from, $to]);
        } elseif ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        return $query;
    }
}
