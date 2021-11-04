<?php

namespace App\Actions\OpenSpaces\File;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UploadPoster
{
    public static function upload($posterData)
    {
        if (!$posterData) {
            return;
        }
        $cover_page_data = substr($posterData, strpos($posterData, ",") + 1);
        $resourceDisk = config('filesystems.resource_disk');
        if ($cover_page_data) {
            $cover_page_name = Str::random(16) . '.png';
            $base64Data = base64_decode($cover_page_data);
            if ($resourceDisk === 'IPFS') {
                return app('IPFS')::add($base64Data, $cover_page_name, ['pin' => true])['Hash'];
            } else {
                $cover_page_path = 'posters' . '/' . $cover_page_name;
                Storage::disk($resourceDisk)->put($cover_page_path, $base64Data);
                return $cover_page_path;
            }
        }
        return;
    }
}
