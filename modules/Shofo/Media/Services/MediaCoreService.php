<?php

namespace Shofo\Media\Services;

use Shofo\Media\Model\Media;

class MediaCoreService
{

    public static function upload($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());

        foreach (config("MediaFileConfig.MediaFileServices") as $key => $service) {
            if (in_array($extension, $service['extensions'])) {
                $media = new Media();
                $media->files = $service['handler']::upload($file);
                $media->user_id = auth()->id();
                $media->type = $key;
                $media->filename = $file->getClientOriginalName();
                $media->save();
                return $media;
            }
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
