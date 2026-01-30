<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\RevenueType;
use Illuminate\Http\Request;

class RevenueReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $revenueTypes = RevenueType::orderBy('name')->get();
        $revenues = $this->revenueQuery($request)->get();


        return view('staff.reports.revenues.index', compact('revenues', 'revenueTypes'));
    }

    private function revenueQuery(Request $request)
    {

        $query = Revenue::query()
            ->with(['revenueType', 'revenueCollection'])
            ->orderBy('created_at', 'desc');

        // if ($request->filled('date_from') && $request->filled('date_to')) {
        //     $from = $request->date_from;
        //     $to = $request->date_to;

        //     $query->whereHas('revenueCollection', function ($q) use ($from, $to) {
        //         $q->whereBetween('collection_date', [$from, $to]);
        //     });
        // } 
        if ($request->filled('date_from')) {
            $query->whereHas('revenueCollection', function ($q) use ($request) {
                $q->whereDate('collection_date', '>=', $request->date_from);
            });
        }

        if ($request->filled('date_to')) {
            $query->whereHas('revenueCollection', function ($q) use ($request) {
                $q->whereDate('collection_date', '<=', $request->date_to);
            });
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('revenue_type_id')) {
            $query->where('revenue_type_id', $request->revenue_type_id);
        }

        return $query;
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
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revenue $revenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Revenue $revenue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        //
    }
}
