<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Revenue;
use Illuminate\Http\Request;
use App\Models\RevenueCollection;
use Illuminate\Support\Facades\DB;

class FinanceDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now();

        $currentStart = $now->copy()->startOfMonth();
        $currentEnd = $now->copy()->endOfMonth();

        $yearStart = $now->copy()->startOfYear();
        $yearEnd = $now->copy()->endOfYear();

        $currentRevenue = Revenue::whereHas('revenueCollection', function ($q) use ($yearStart, $yearEnd) {
            $q->whereBetween('collection_date', [$yearStart, $yearEnd]);
        })
            ->sum('amount');

        $currentExpenses = Expense::whereBetween('date', [$yearStart->toDateString(), $yearEnd->toDateString()])
            ->sum('amount');

        $currentCollections = RevenueCollection::whereBetween('collection_date', [$yearStart, $yearEnd])
            ->count();

        $savings = $currentRevenue - $currentExpenses;

        // Recent Expenses
        $expenses = Expense::with('category')
            ->orderByDesc('date')
            ->limit(7)
            ->get();

        $recentExpenses = [];
        foreach ($expenses as $expense) {
            $recentExpenses[] = [
                'date' => $expense->date?->toDateString(),
                'category' => $expense->category?->name ?? 'N/A',
                'description' => $expense->description ?? 'N/A',
                'name' => $expense->name ?? 'N/A',
                'amount' => (float) $expense->amount,
            ];
        }

        // Recent Revenues
        $revenues = Revenue::with(['revenueType', 'revenueCollection'])
            ->orderBy(
                RevenueCollection::select('collection_date')
                    ->whereColumn('revenue_collections.id', 'revenues.revenue_collection_id')
            )
            ->limit(7)
            ->get();
        $recentRevenues = [];
        foreach ($revenues as $revenue) {
            $recentRevenues[] = [
                'date' => $revenue->revenueCollection?->collection_date?->toDateString(),
                'type' => $revenue->revenueType?->name ?? 'N/A',
                'method' => $revenue->payment_method === 'gcash' ? 'gcash' : 'cash',
                'beneficiary' => $revenue->beneficiary === 'general' ? 'general' : 'pastor',
                'amount' => (float) $revenue->amount,

            ];
        }

        // Expense by Categories
        $rows = Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
            ->whereNull('expenses.deleted_at')
            ->whereNull('categories.deleted_at')
            ->whereBetween('expenses.date', [$yearStart->toDateString(), $yearEnd->toDateString()])
            ->groupBy('categories.name')
            ->select('categories.name as category')
            ->selectRaw('SUM(expenses.amount) as amount')
            ->orderByDesc('amount')
            ->get();

        $expensesByCategory = [];

        foreach ($rows as $row) {
            $expensesByCategory[] = [
                'category' => $row->category,
                'amount'   => (float) $row->amount,
            ];
        }

        // Revenue by Type
        $revenueByType = Revenue::join('revenue_types', 'revenues.revenue_type_id', '=', 'revenue_types.id')
            ->join('revenue_collections', 'revenues.revenue_collection_id', '=', 'revenue_collections.id')
            ->whereNull('revenues.deleted_at')
            ->whereNull('revenue_types.deleted_at')
            ->whereNull('revenue_collections.deleted_at')
            ->whereBetween('revenue_collections.collection_date', [$yearStart, $yearEnd])
            ->groupBy('revenue_types.name')
            ->orderByDesc(DB::raw('SUM(revenues.amount)'))
            ->get([
                'revenue_types.name as type',
                DB::raw('SUM(revenues.amount) as amount'),
            ])
            ->map(fn($r) => ['type' => $r->type, 'amount' => (float) $r->amount]);


        $revenueByMonth = Revenue::join('revenue_collections as rc', 'revenues.revenue_collection_id', '=', 'rc.id')
            ->whereNull('revenues.deleted_at')
            ->whereNull('rc.deleted_at')
            ->whereBetween('rc.collection_date', [$yearStart, $yearEnd])
            ->selectRaw('MONTH(rc.collection_date) as m, 
                DATE_FORMAT(rc.collection_date, "%b") as month,
                SUM(revenues.amount) as revenue')
            ->groupBy('m', 'month')
            ->orderBy('m')
            ->get()
            ->map(fn($r) => ['month' => $r->month, 'revenue' => (float) $r->revenue])
            ->values();





        return view('staff.dashboard.finance.index', [
            'currentRevenue' => $currentRevenue,
            'currentStart'   => $currentStart,
            'currentEnd'     => $currentEnd,
            'currentExpenses' => $currentExpenses,
            'savings' => $savings,
            'currentCollections' => $currentCollections,
            'recentExpenses' => $recentExpenses,
            'recentRevenues' => $recentRevenues,
            'expensesByCategory' => $expensesByCategory,
            'revenueByType' => $revenueByType,
            'revenueByMonth' => $revenueByMonth,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
