<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileUploadService
{
    /**
     *
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string
     */
    public function upload(UploadedFile $file, string $directory): string
    {
        $destinationPath = public_path($directory);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        // Return the relative file path
        return $directory . '/' . $fileName;
    }
}