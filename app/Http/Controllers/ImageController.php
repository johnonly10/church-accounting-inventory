<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Image::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('path', 'like', "%{$search}%");
            });
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }


        $images = $query->orderBy('id')->paginate(10)->withQueryString();
        return view('staff.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'      => 'required|in:logo,background,background_2',
            'name'      => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
            'path'      => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ]);

        $isActive = $request->boolean('is_active');

        if ($isActive) {
            Image::where('type', $validated['type'])->update(['is_active' => false]);
        }

        $folder = public_path('Images');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $request->file('path');
        $ext = $file->getClientOriginalExtension();

        $filename =
            $validated['type'] . '-' .
            Str::slug($validated['name']) . '-' .
            now()->format('YmdHis') . '-' .
            Str::random(6) . '.' . $ext;

        $file->move($folder, $filename);

        $dbPath = 'Images/' . $filename;

        Image::create([
            'type'      => $validated['type'],
            'name'      => $validated['name'],
            'path'      => $dbPath,
            'is_active' => $isActive,
        ]);

        return redirect()->route('staff.images.index')->with('success', 'Image saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        return view('staff.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        $validated = $request->validate([
            'type'      => 'required|in:logo,background,background_2',
            'name'      => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
            'path'      => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
        ]);

        $isActive = $request->boolean('is_active');

        if ($isActive) {
            Image::where('type', $validated['type'])
                ->where('id', '!=', $image->id)
                ->update(['is_active' => false]);
        }

        $image->type = $validated['type'];
        $image->name = $validated['name'];
        $image->is_active = $isActive;

        if ($request->hasFile('path')) {
            $folder = public_path('Images');
            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0755, true);
            }

            if ($image->path && File::exists(public_path($image->path))) {
                File::delete(public_path($image->path));
            }

            $file = $request->file('path');
            $ext = $file->getClientOriginalExtension();

            $filename =
                $validated['type'] . '-' .
                Str::slug($validated['name']) . '-' .
                now()->format('YmdHis') . '-' .
                Str::random(6) . '.' . $ext;

            $file->move($folder, $filename);

            $image->path = 'Images/' . $filename;
        }

        $image->save();

        return redirect()->route('staff.images.index')->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        if ($image->path && File::exists(public_path($image->path))) {
            File::delete(public_path($image->path));
        }

        $image->delete();

        return redirect()->route('staff.images.index')->with('success', 'Image deleted successfully.');
    }
}
