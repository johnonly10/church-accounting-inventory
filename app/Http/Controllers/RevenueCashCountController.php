<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Raw;
use App\Models\RevenueCashCount;
use App\Services\RevenueCashCountCollectionService;
use App\Http\Requests\Revenue\RevenueCashCount\StoreRevenueCashCountRequest;
use App\Models\RevenueType;

class RevenueCashCountController extends Controller
{

    protected RevenueCashCountCollectionService $revenueCashCountCollectionService;

    public function __construct(RevenueCashCountCollectionService $revenueCashCountCollectionService)
    {
        $this->revenueCashCountCollectionService = $revenueCashCountCollectionService;
    }

    public function index(Request $request)
    {
        $revenueCashCounts = $this->revenueCashCountCollectionService->getPaginateRevenueCashCount($request);
        return view('staff.revenue-denomination.index', compact('revenueCashCounts'));
    }

    public function create()
    {
        $revenueTypes = RevenueType::orderBy('name')->get();
        return view('staff.revenue-denomination.create', compact('revenueTypes'));
    }

    public function store(StoreRevenueCashCountRequest $request)
    {
        // dd($request->all());
        RevenueCashCount::create($request->validated());
        return redirect()->route('staff.revenue-cash-counts.index')->with('success', 'Revenue Denomination created successfully.');
    }

    public function edit(RevenueCashCount $revenueCashCount)
    {
        $revenueTypes = RevenueType::orderBy('name')->get();
        return view('staff.revenue-denomination.edit', compact('revenueCashCount', 'revenueTypes'));
    }

    public function update(StoreRevenueCashCountRequest $request, RevenueCashCount $revenueCashCount)
    {
        $revenueCashCount->update($request->validated());

        return redirect()->route('staff.revenue-cash-counts.index')->with('success', 'Revenue Denomination created successfully.');
    }

    public function archived(Request $request)
    {
        $revenueCashCounts = $this->revenueCashCountCollectionService->getArchiveRevenueCashCount($request);
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
