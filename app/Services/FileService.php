<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;

class FileService
{
    protected ImageManager $imageManager;

    public function __construct()
    {
        // Initialize the ImageManager once
        $this->imageManager = new ImageManager(new Driver());
    }

    /**
     * Store a file with optional resizing for images.
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $disk
     * @param int|null $width
     * @param int|null $height
     * @return string  Stored file path (relative to disk root)
     * @throws Exception
     */
    public function store(
        UploadedFile $file,
        string $path,
        string $disk = 'public',
        ?int $width = null,
        ?int $height = null
    ): string {
        try {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $storagePath = trim($path, '/') . '/' . $filename;

            $isImage = str_starts_with($file->getMimeType(), 'image/');

            if ($isImage && ($width || $height)) {
                $image = $this->imageManager->read($file->getRealPath());

                if ($width && $height) {
                    $image->cover($width, $height);
                } elseif ($width) {
                    $image->scale(width: $width);
                } elseif ($height) {
                    $image->scale(height: $height);
                }

                // Save processed image to storage
                Storage::disk($disk)->put($storagePath, (string) $image->encode());
            } else {
                // Store file directly without modification
                Storage::disk($disk)->putFileAs($path, $file, $filename);
            }

            return $storagePath;
        } catch (Exception $e) {
            throw new Exception('File upload failed: ' . $e->getMessage());
        }
    }

    /**
     * Safely remove a stored file.
     */
    public function remove(?string $filePath, string $disk = 'public'): void
    {
        if ($filePath && Storage::disk($disk)->exists($filePath)) {
            Storage::disk($disk)->delete($filePath);
        }
    }

    /**
     * Retrieve the public URL of a stored file.
     */
    public function url(?string $filePath, string $disk = 'public'): ?string
    {
        return $filePath ? Storage::disk($disk)->url($filePath) : null;
    }
}
