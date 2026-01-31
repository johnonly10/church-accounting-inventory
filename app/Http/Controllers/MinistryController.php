<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ministry\StoreMinistryRequest;
use App\Models\Department;
use App\Models\Ministry;
use App\Services\MinistryService;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class MinistryController extends Controller
{

    protected MinistryService $ministryService;

    public function __construct(MinistryService $ministryService)
    {
        $this->ministryService = $ministryService;
    }

    public function index(Request $request)
    {
        $ministries = $this->ministryService->getPaginateMinistry($request);
        return view('staff.ministry.index', compact('ministries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.ministry.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMinistryRequest $request)
    {
        Ministry::create($request->validated());
        return redirect()->route('staff.ministries.index')->with('success', 'Ministry Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ministry $ministry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ministry $ministry)
    {
        return view('staff.ministry.edit', compact('ministry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMinistryRequest $request, Ministry $ministry)
    {
        $ministry->update($request->validated());
        return redirect()->route('staff.ministries.index')->with('success', 'Ministry Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ministry $ministry)
    {
        //
    }

    public function archived(Request $request)
    {

        $ministries = $this->ministryService->getArchiveMinistry($request);
        return view('staff.ministry.archive', compact('ministries'));
    }

    public function archive(Ministry $ministry)
    {
        $ministry->delete();
        return redirect()->route('staff.ministries.index')->with('success', 'Ministry Successfully Archived');
    }

    public function restore($id)
    {
        $ministries = Ministry::onlyTrashed()->findOrFail($id);
        $ministries->restore();
        return redirect()->route('staff.ministries.archived')->with('success', 'Ministry Successfully Restored');
    }

    public function forceDelete($id)
    {
        $ministries = Ministry::onlyTrashed()->findOrFail($id);
        $ministries->forceDelete();
        return redirect()->route('staff.ministries.archived')->with('success', 'Ministry Successfully Deleted');
    }
}
