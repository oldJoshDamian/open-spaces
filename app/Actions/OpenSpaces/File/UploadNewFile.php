<?php

namespace App\Actions\OpenSpaces\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadNewFile
{
    public static function upload(UploadedFile $uploadedFile)
    {
        $mime_type = $uploadedFile->getMimeType();
        $uploadedFileName = $uploadedFile->getClientOriginalName();
        $resourceDisk = config('filesystems.resource_disk');
        if ($resourceDisk === 'IPFS') {
            $uploadedFilepath = app('IPFS')::add(fopen($uploadedFile, 'r+'), $uploadedFileName, ['pin' => true])['Hash'];
        } else {
            $uploadedFilepath = Storage::disk($resourceDisk)->put('resources', $uploadedFile);
        }
        return [
            'filePath' => $uploadedFilepath,
            'mimeType' => $mime_type,
            'fileName' => $uploadedFileName
        ];
    }
}
