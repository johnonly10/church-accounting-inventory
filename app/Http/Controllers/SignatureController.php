<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Signature;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signatures = Signature::with('position')->orderBy('id')->paginate(10);
        return view('staff.signatures.index', compact('signatures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::orderBy('id')->get();
        return view('staff.signatures.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'is_active' => 'boolean',
        ]);

        Signature::create($validated);
        return redirect()->route('staff.signatures.index')->with('success', 'Signature Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Signature $signature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Signature $signature)
    {
        $positions = Position::orderBy('id')->get();
        return view('staff.signatures.edit', compact('signature', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Signature $signature)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'is_active' => 'boolean',
        ]);

        $signature->update($validated);
        return redirect()->route('staff.signatures.index')->with('success', 'Signature Sucessfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Signature $signature)
    {
        //
    }
}
