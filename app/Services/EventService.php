<?php

namespace App\Services;

class EventService
{
    public function upload($image): string
    {
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('Images/Events'), $imageName);
        return 'Images/Events/' . $imageName;
    }

    public function replace($image, ?string $oldImagePath): string
    {
        if ($oldImagePath && file_exists(public_path($oldImagePath))) {
            unlink(public_path($oldImagePath));
        }

        return $this->upload($image);
    }

    public function delete(?string $imagePath): void
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }
    }
}
