<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageService
{
    public function getAuthImages()
    {
        $images = Image::query()
            ->where('is_active', true)
            ->whereIn('type', ['logo', 'background', 'background_2'])
            ->get()
            ->keyBy('type');

        return [
            'logoPath' => $images['logo']->path ?? null,
            'bgPath' => $images['background']->path ?? null,
            'bg2Path' => $images['background_2']->path ?? null
        ];
    }

    protected function applyFilters($query, Request $request)
    {
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

        return $query;
    }

    public function getPaginatedImages(Request $request)
    {
        $query = Image::query();
        $query = $this->applyFilters($query, $request);
        return $query->orderBy('id')->paginate(10)->withQueryString();
    }

    public function store(array $validated, bool $isActive, $file): Image
    {
        if ($isActive) {
            Image::where('type', $validated['type'])
                ->update(['is_active' => false]);
        }

        $path = $this->uploadImage($validated, $file);

        return Image::create([
            'type'      => $validated['type'],
            'name'      => $validated['name'],
            'path'      => $path,
            'is_active' => $isActive,
        ]);
    }

    public function update(Image $image, array $validated, bool $isActive, $file = null): Image
    {
        if ($isActive) {
            Image::where('type', $validated['type'])
                ->where('id', '!=', $image->id)
                ->update(['is_active' => false]);
        }

        $image->type      = $validated['type'];
        $image->name      = $validated['name'];
        $image->is_active = $isActive;

        if ($file) {
            $this->deleteOldImage($image);
            $image->path = $this->uploadImage($validated, $file);
        }

        $image->save();

        return $image;
    }

    private function uploadImage(array $validated, $file): string
    {
        $folder = public_path('Images');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename =
            $validated['type'] . '-' .
            Str::slug($validated['name']) . '-' .
            now()->format('YmdHis') . '-' .
            Str::random(6) . '.' .
            $file->getClientOriginalExtension();

        $file->move($folder, $filename);

        return 'Images/' . $filename;
    }

    private function deleteOldImage(Image $image): void
    {
        if ($image->path && File::exists(public_path($image->path))) {
            File::delete(public_path($image->path));
        }
    }
}
