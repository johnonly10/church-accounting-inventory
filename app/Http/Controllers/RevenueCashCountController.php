<?php

namespace App\Http\Controllers;

use App\Models\RevenueCashCount;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class RevenueCashCountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RevenueCashCount::query();

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        };

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=',  $request->date_to);
        };


        $revenueCashCounts = $query->orderBy('date')->paginate(10)->withQueryString();

        return view('staff.revenue-denomination.index', compact('revenueCashCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.revenue-denomination.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],

            // Bills
            'bill_1000' => ['nullable', 'integer', 'min:0'],
            'bill_500'  => ['nullable', 'integer', 'min:0'],
            'bill_200'  => ['nullable', 'integer', 'min:0'],
            'bill_100'  => ['nullable', 'integer', 'min:0'],
            'bill_50'   => ['nullable', 'integer', 'min:0'],
            'bill_20'   => ['nullable', 'integer', 'min:0'],

            // Coins
            'coin_20' => ['nullable', 'integer', 'min:0'],
            'coin_10' => ['nullable', 'integer', 'min:0'],
            'coin_5'  => ['nullable', 'integer', 'min:0'],
            'coin_1'  => ['nullable', 'integer', 'min:0'],

            // Centavos
            'centimo_25' => ['nullable', 'integer', 'min:0'],
            'centimo_10' => ['nullable', 'integer', 'min:0'],
            'centimo_5'  => ['nullable', 'integer', 'min:0'],
            'centimo_1'  => ['nullable', 'integer', 'min:0'],
        ]);
        RevenueCashCount::create($validated);

        return redirect()->route('staff.revenue-cash-counts.index')->with('success', 'Revenue Denomination created successfully.');
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
    public function edit(RevenueCashCount $revenueCashCount)
    {
        return view('staff.revenue-denomination.edit', compact('revenueCashCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RevenueCashCount $revenueCashCount)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],

            // Bills
            'bill_1000' => ['nullable', 'integer', 'min:0'],
            'bill_500'  => ['nullable', 'integer', 'min:0'],
            'bill_200'  => ['nullable', 'integer', 'min:0'],
            'bill_100'  => ['nullable', 'integer', 'min:0'],
            'bill_50'   => ['nullable', 'integer', 'min:0'],
            'bill_20'   => ['nullable', 'integer', 'min:0'],

            // Coins
            'coin_20' => ['nullable', 'integer', 'min:0'],
            'coin_10' => ['nullable', 'integer', 'min:0'],
            'coin_5'  => ['nullable', 'integer', 'min:0'],
            'coin_1'  => ['nullable', 'integer', 'min:0'],

            // Centavos
            'centimo_25' => ['nullable', 'integer', 'min:0'],
            'centimo_10' => ['nullable', 'integer', 'min:0'],
            'centimo_5'  => ['nullable', 'integer', 'min:0'],
            'centimo_1'  => ['nullable', 'integer', 'min:0'],
        ]);
        $revenueCashCount->update($validated);

        return redirect()->route('staff.revenue-cash-counts.index')->with('success', 'Revenue Denomination created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function archived(Request $request)
    {
        $query = RevenueCashCount::onlyTrashed();

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        };
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=',  $request->date_to);
        };
        $revenueCashCounts = $query->orderBy('id')->paginate(10);
        return view('staff.revenue-denomination.archive', compact('revenueCashCounts'));
    }

    public function archive(RevenueCashCount $revenueCashCounts)
    {
        $revenueCashCounts->delete();
        return redirect()->route('staff.revenue-cash-counts.index')->with('success', 'Denomination Successfully Archived');
    }
    public function restore($id)
    {
        $revenueCashCounts = RevenueCashCount::onlyTrashed()->findOrFail($id);
        $revenueCashCounts->restore($id);

        return redirect()->route('staff.revenue-cash-counts.archived')->with('success', 'Denomination Successfully Archived');
    }

    public function forceDelete($id)
    {
        $revenueCashCounts = RevenueCashCount::onlyTrashed()->findOrFail($id);
        $revenueCashCounts->forceDelete($id);

        return redirect()->route('staff.revenue-cash-counts.archived')->with('success', 'Denomination Successfully Deleted');
    }
}
