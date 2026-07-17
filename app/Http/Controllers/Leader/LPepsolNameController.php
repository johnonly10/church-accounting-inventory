<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\PepsolName;
use Illuminate\Http\Request;

class LPepsolNameController extends Controller
{
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

    public function create()
    {
        return view('leader.pepsol.names.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pepsol_names,name',
            'code' => 'required|string|max:255|unique:pepsol_names,code',
            'image' => 'required|image|mimes:jpeg,png,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('Images/Pepsol/Name'), $imageName);

            $validated['image'] = $imageName;
        }

        PepsolName::create($validated);

        return redirect()
            ->route('leader.pepsol-names.index')
            ->with('success', 'Pepsol Name created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(PepsolName $pepsolName)
    {
        return view('leader.pepsol.names.edit', compact('pepsolName'));
    }

    public function update(Request $request, PepsolName $pepsolName)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pepsol_names,name,' . $pepsolName->id,
            'code' => 'required|string|max:255|unique:pepsol_names,code,' . $pepsolName->id,
            'image' => 'nullable|image|mimes:jpeg,png,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($pepsolName->image) {
                $oldImagePath = public_path('Images/Pepsol/Name/' . $pepsolName->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Images/Pepsol/Name'), $imageName);
            $validated['image'] = $imageName;
        }

        $pepsolName->update($validated);

        return redirect()->route('leader.pepsol-names.index')->with('success', 'Pepsol Name updated successfully.');
    }

    public function destroy(PepsolName $pepsolName)
    {
        if ($pepsolName->image) {
            $imagePath = public_path('Images/Pepsol/Name/' . $pepsolName->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $pepsolName->delete();

        return redirect()->route('leader.pepsol-names.index')->with('success', 'Pepsol Name deleted successfully.');
    }
}
