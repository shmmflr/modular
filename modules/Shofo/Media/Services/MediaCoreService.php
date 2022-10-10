<?php

namespace Shofo\Media\Services;

use Shofo\Media\Model\Media;

class MediaCoreService
{

    public static function upload($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        switch ($extension) {
            case 'png':
            case 'jpg':
            case'jpeg':
                $media = new Media();
                $media->files = ImageFileService::upload($file);
                $media->user_id = auth()->id();
                $media->type = 'image';
                $media->filename = $file->getClientOriginalName();
                $media->save();
                return $media;

            case 'mp4':
            case 'wmv':
            case 'mkv':
                VideoFileService::upload($file);
                break;
        }
    }

    public static function delete($media)
    {
        switch ($media->type) {
            case 'image':
                ImageFileService::delete($media);
                break;
        }
    }

}
