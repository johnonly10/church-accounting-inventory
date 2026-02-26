<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Requests\Image\UpdateImageRequest;

class ImageController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        $images = $this->imageService->getPaginatedImages($request);
        return view('leader.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leader.images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $this->imageService->store(
            $request->validdated(),
            $request->boolean('is_active'),
            $request->file('ath')
        );
        return redirect()->route('leader.images.index')->with('success', 'Image saved successfully.');
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
        return view('leader.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $this->imageService->update(
            $image,
            $request->validated(),
            $request->boolean('is_active'),
            $request->file('path')
        );

        return redirect()
            ->route('leader.images.index')
            ->with('success', 'Image updated successfully.');
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

        return redirect()->route('leader.images.index')->with('success', 'Image deleted successfully.');
    }
}
