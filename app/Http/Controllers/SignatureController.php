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
    public function index(Request $request)
    {
        $query = Signature::with('position');

        $this->applyFilters($query, $request);

        $positions = Position::all()->pluck('name', 'id');
        $signatures = $query->orderBy('id')->paginate(10);
        return view('staff.signatures.index', compact('signatures', 'positions'));
    }

    private function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('label', 'like', "%{$search}%");
            });
        }
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

    public function archived(Request $request)
    {
        $query = Signature::onlyTrashed()->with('position');
        $this->applyFilters($query, $request);
        $signatures = $query->orderBy('deleted_at', 'desc')->paginate(10);
        return view('staff.signatures.archive', compact('signatures'));
    }

    public function archive(Signature $signature)
    {
        $signature->delete();
        return redirect()->route('staff.signatures.index')->with('success', 'Signature Successfully Archived');
    }

    public function restore($id)
    {
        $signatures = Signature::onlyTrashed()->findOrFail($id);
        $signatures->restore($id);
        return  redirect()->route('staff.signatures.archived')->with('success', 'Signature Successfully Restored');
    }

    public function forceDelete($id)
    {
        $signatures = Signature::onlyTrashed()->findOrFail($id);
        $signatures->forceDelete($id);
        return redirect()->route('staff.signatures.archived')->with('success', 'Signature Successfully Deleted');
    }
}
