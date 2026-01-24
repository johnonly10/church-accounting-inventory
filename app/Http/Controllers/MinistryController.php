<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ministry;
use Illuminate\Http\Request;

class MinistryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ministry::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $ministries = $query->orderBy('id')->paginate(10)->withQueryString();
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ministries,name'
        ]);

        Ministry::create($validated);
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
    public function update(Request $request, Ministry $ministry)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ministries,name,' . $ministry->id
        ]);

        $ministry->update($validated);
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
        $query = Ministry::onlyTrashed();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $ministries = $query->orderBy('deleted_at', 'desc')->paginate(10);
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
