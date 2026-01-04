<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaders = Leader::orderBy('id')->paginate(10);
        return view('staff.leaders.index', compact('leaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.leaders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'cell_name' => 'required|string|max:255',

        ]);

        Leader::create($validated);
        return redirect()->route('staff.leaders.index')->with('success', 'Leaders Succesfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leader $leader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leader $leader)
    {
        return view('staff.leaders.edit', compact('leader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leader $leader)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'cell_name' => 'required|string|max:255',
        ]);

        $leader->update($validated);
        return redirect()->route('staff.leaders.index')->with('success', "Leader's Information Successfully Updated");
    }

    public function archive(Leader $leader)
    {
        $leader->delete();
        return redirect()->route('staff.leaders.index')->with('success', 'Leader archived Successfully');
    }

    public function archived()
    {
        $leaders = Leader::onlyTrashed()->paginate(10);
        return view('staff.leaders.archive', compact('leaders'));
    }

    public function restore($id)
    {
        $leader = Leader::onlyTrashed()->findOrFail($id);
        $leader->restore();
        return redirect()->route('staff.leaders.archived')->with('success', 'Leader restore Successfully');
    }

    public function forceDelete($id)
    {
        $leader = Leader::onlyTrashed()->findOrFail($id);
        $leader->forceDelete();
        return redirect()->route('staff.leaders.archived')->with('success', 'Leader permanently Deleted');
    }
}
