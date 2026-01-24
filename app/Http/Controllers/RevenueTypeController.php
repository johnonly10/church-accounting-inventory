<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\RevenueType;
use Illuminate\Http\Request;

class RevenueTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = RevenueType::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $revenue_types = $query->orderBy('id')->paginate(10);
        return view('staff.revenue-types.index', compact('revenue_types'));
    }

    public function create()
    {
        return view('staff.revenue-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:revenue_types,name',
        ]);

        RevenueType::create($validated);
        return redirect()->route('staff.revenue-types.index')->with('success', 'Revenue Type Successfully Created');
    }

    public function edit(RevenueType $revenueType)
    {
        return view('staff.revenue-types.edit', compact('revenueType'));
    }

    public function update(Request $request, RevenueType $revenueType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:revenue_types,name,' . $revenueType->id
        ]);

        $revenueType->update($validated);
        return redirect()->route('staff.revenue-types.index')->with('success', 'Revenue Type Successfully Updated');
    }

    public function archived(Request $request)
    {
        $query = RevenueType::onlyTrashed();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        $revenue_types = $query->paginate(10);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

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
