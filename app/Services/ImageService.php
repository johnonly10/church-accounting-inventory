<?php

namespace App\Services;

use App\Models\Image;

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
}
