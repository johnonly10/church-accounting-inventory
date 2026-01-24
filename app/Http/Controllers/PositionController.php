<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Position::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $positions = $query->orderBy('name')->paginate(10);
        return view('staff.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:positions,name',
        ]);

        Position::create($validated);
        return redirect()->route('staff.positions.index')->with('success', 'Position Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('staff.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:positions,name,' . $position->id,
        ]);
        $position->update($validated);
        return redirect()->route('staff.positions.index')->with('success', 'Position Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
    }

    public function archived(Request $request)
    {
        $query = Position::onlyTrashed();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        $positions = $query->paginate(10);

        return view('staff.positions.archive', compact('positions'));
    }

    public function archive(Position $position)
    {
        $position->delete();
        return redirect()->route('staff.positions.index')->with('success', 'Position Successfully Archived');
    }

    public function restore($id)
    {
        $positions = Position::onlyTrashed()->findOrFail($id);
        $positions->restore($id);
        return redirect()->route('staff.positions.archived')->with('success', 'Position Successfully Restored');
    }

    public function forceDelete($id)
    {
        $positions = Position::onlyTrashed()->findOrFail($id);
        $positions->forceDelete($id);

        return redirect()->route('staff.positions.archived')->with('success', 'Position Successfully Deleted');
    }
}
