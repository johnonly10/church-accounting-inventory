<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\RevenueType;
use Illuminate\Http\Request;
use App\Http\Requests\Revenue\RevenueType\StoreRevenueTypeRequest;
use App\Services\RevenueTypeService;

class RevenueTypeController extends Controller
{
    protected RevenueTypeService $revenueTypeService;

    public function __construct(RevenueTypeService $revenueTypeService)
    {
        $this->revenueTypeService = $revenueTypeService;
    }

    public function index(Request $request)
    {
        $revenue_types = $this->revenueTypeService->getPaginateRevenueType($request);
        return view('staff.revenue-types.index', compact('revenue_types'));
    }

    public function create()
    {
        return view('staff.revenue-types.create');
    }

    public function store(StoreRevenueTypeRequest $request)
    {
        RevenueType::create($request->validated());
        return redirect()->route('staff.revenue-types.index')->with('success', 'Revenue Type Successfully Created');
    }

    public function edit(RevenueType $revenueType)
    {
        return view('staff.revenue-types.edit', compact('revenueType'));
    }

    public function update(StoreRevenueTypeRequest $request, RevenueType $revenueType)
    {
        $revenueType->update($request->validated());
        return redirect()->route('staff.revenue-types.index')->with('success', 'Revenue Type Successfully Updated');
    }

    public function archived(Request $request)
    {
        $revenue_types = $this->revenueTypeService->getArchiveRevenueType($request);
        return view('staff.revenue-types.archive', compact('revenue_types'));
    }

    public function archive(RevenueType $revenueType)
    {
        $revenueType->delete();
        return redirect()->route('staff.revenue-types.index')->with('success', 'Revenue Type Successfully Archived');
    }

    public function restore($id)
    {
        $revenue_types = RevenueType::onlyTrashed()->findOrFail($id);
        $revenue_types->restore($id);
        return redirect()->route('staff.revenue-types.archived')->with('success', 'Revenue Type Successfully Restored');
    }

    public function forceDelete($id)
    {
        $revenue_types = RevenueType::onlyTrashed()->findOrFail($id);
        $revenue_types->forceDelete();
        return redirect()->route('staff.revenue-types.archived')->with('success', 'Revenue Type Successfully Deleted');
    }
}
