<?php

namespace Shofo\Media\Services;

use Illuminate\Http\UploadedFile;
use Shofo\Media\Contracts\FileServiceContract;

class ZipFileService implements FileServiceContract
{
    public static function upload(UploadedFile $file): array
    {
        $fileName = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'app\public\Zip\\';
        $file->move(storage_path($dir), $fileName . '.' . $extension);
        $path = $dir . '\\' . $fileName . '.' . $extension;
        return ['Zip' => $path];
    }

    public static function delete($media)
    {
        // TODO: Implement delete() method.
    }
}
