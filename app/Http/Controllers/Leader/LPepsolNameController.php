<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\PepsolName;
use Illuminate\Http\Request;

class LPepsolNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PepsolName::orderBy('name');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $pepsolNames = $query->paginate(10);
        return view('leader.pepsol.names.index', compact('pepsolNames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leader.pepsol.names.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pepsol_names,name',
            'code' => 'required|string|max:255,unique:pepsol_names,code',
        ]);

        PepsolName::create($validated);
        return redirect()->route('leader.pepsol-names.index')->with('success', 'Name Created Successfully');
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
    public function edit(PepsolName $pepsolName)
    {
        return view('leader.pepsol.names.edit', compact('pepsolName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PepsolName $pepsolName)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pepsol_names,name,' . $pepsolName->id,
            'code' => 'required|string|max:255|unique:pepsol_names,code,' . $pepsolName->id,
        ]);

        $pepsolName->update($validated);
        return redirect()->route('leader.pepsol-names.index')->with('success', 'Names updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PepsolName $pepsolName)
    {
        $pepsolName->delete();
        return redirect()->route('leader.pepsol-names.index')->with('success', 'Name deleted Successfully');
    }
}
