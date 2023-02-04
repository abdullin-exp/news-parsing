<?php

namespace App\Services\RSS\RBC\Support;

use Illuminate\Support\Facades\Storage;

class Image
{
    public function save(array $image): ?string
    {
        if (!$this->isValidType($image['type'])) {
            return null;
        }

        $contents = file_get_contents($image['url']);
        $name = substr($image['url'], strrpos($image['url'], '/') + 1);

        Storage::disk('public')->put('images/rbc/' . $name, $contents);

        return '/storage/images/rbc/' . $name;
    }

    private function isValidType(string $type): bool
    {
        $allowedMimeTypes = [
            'image/gif',
            'image/jpeg',
            'image/jpg',
            'image/pjpeg',
            'image/x-png',
            'image/png',
            'image/svg+xml'
        ];

        if (!in_array($type, $allowedMimeTypes)) {
            return false;
        }

        return true;
    }
}
