<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaRepository
{
    protected string $basePath;

    public function __construct()
    {
        $this->basePath = storage_path('app/public');
    }

    /**
     * Detect all folders inside storage/app/public
     */
    public function getFolders(): array
    {
        if (!is_dir($this->basePath)) {
            return [];
        }

        return collect(File::directories($this->basePath))
            ->map(fn($dir) => basename($dir))
            ->values()
            ->toArray();
    }

    /**
     * Get all files grouped by folder
     */
    public function getAllGrouped(): array
    {
        $folders = $this->getFolders();
        $grouped = [];

        foreach ($folders as $folder) {
            $grouped[$folder] = $this->getFiles($folder);
        }

        return $grouped;
    }

    /**
     * Get all files in a given folder
     */
    public function getFiles(string $folder): array
    {
        $folderPath = $this->basePath . '/' . $folder;
        if (!is_dir($folderPath)) {
            return [];
        }

        return collect(File::files($folderPath))->map(function ($file) use ($folder) {
            $relativePath = "storage/{$folder}/" . $file->getFilename();
            return [
                'path' => $relativePath,
                'url' => asset($relativePath),
                'size' => $file->getSize(),
                'folder' => $folder,
                'last_modified' => date('Y-m-d H:i:s', $file->getMTime()),
            ];
        })->toArray();
    }

    /**
     * Delete a file using helper
     */
    public function delete(string $path)
    {
        $relativePath = str_replace('storage/', '', $path);
        return file_remove($relativePath, 'public');
    }

    /**
     * Delete an entire folder (and its files) from public storage.
     */
    public function deleteFolder(string $folderName)
    {
        $disk = 'public';
        $folderPath = $folderName;

        // Check if the folder exists
        if (!Storage::disk($disk)->exists($folderPath)) {
            return false;
        }

        // Delete all files and subdirectories inside
        Storage::disk($disk)->deleteDirectory($folderPath);

        // Verify deletion
        return !Storage::disk($disk)->exists($folderPath);
    }

}
