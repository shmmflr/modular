<?php

namespace Shofo\Media\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageFileService
{
    protected static array $sizes = ['100', '300', '600', '900'];

    public static function upload($file)
    {
        $fileName = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'app\public\Image\\';
        $file->move(storage_path($dir), $fileName . '.' . $extension);
        $path = $dir . '\\' . $fileName . '.' . $extension;
        return self::resizeImage(storage_path($path), $dir, $fileName, $extension);


    }

    protected static function resizeImage($img, $dir, $fileName, $extension)
    {
        $img = Image::make($img);
        $images['original'] = $fileName . '.' . $extension;
        foreach (self::$sizes as $size) {
            $images[$size] = $fileName . '_' . $size . '.' . $extension;
            $img->resize($size, null,
                function ($aspect) {
                    $aspect->aspectRatio();
                })->save(storage_path($dir) .
                $fileName . '_' . $size . '.' . $extension);
        }
        return $images;
    }

    public static function delete($media)
    {
        foreach ($media->files as $file) {
            Storage::delete('public\Image\\' . $file);
        }
    }

}
