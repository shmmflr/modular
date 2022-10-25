<?php

namespace Shofo\Media\Services;

class VideoFileService
{
    public static function upload($file)
    {
        $fileName = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'app\public\Video\\';
        $file->move(storage_path($dir), $fileName . '.' . $extension);
        $path = $dir . '\\' . $fileName . '.' . $extension;
        return ['video' => $path];
    }
}
