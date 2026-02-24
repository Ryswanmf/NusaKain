<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Optimize and convert image to WebP
     */
    public function optimizeToWebP($file, $directory = 'uploads', $quality = 80)
    {
        // Ensure directory exists
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $filename = Str::random(20) . '.webp';
        $path = $directory . '/' . $filename;

        $image = $this->manager->read($file);
        
        $encoded = $image->toWebp($quality);

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }
}
