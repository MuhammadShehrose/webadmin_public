<?php

use App\Services\FileService;

if (!function_exists('file_upload')) {
    /**
     * Global upload helper
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param string $disk
     * @param int|null $width
     * @param int|null $height
     * @return string
     */
    function file_upload($file, string $path, string $disk = 'public', ?int $width = null, ?int $height = null)
    {
        return app(FileService::class)->store($file, $path, $disk, $width, $height);
    }
}

if (!function_exists('file_remove')) {
    /**
     * Global remove helper
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param string $disk
     * @return bool
     */
    function file_remove(string $path, string $disk = 'public')
    {
        return app(FileService::class)->remove($path, $disk);
    }
}
