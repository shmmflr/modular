<?php
return [
    "MediaFileServices" => [
        "image" => [
            "extensions" => ["jpeg", "jpg", "png"],
            "handler" => \Shofo\Media\Services\ImageFileService::class,
        ],
        "video" => [
            "extensions" => ["avi", "mp4", "mkv"],
            "handler" => \Shofo\Media\Services\VideoFileService::class,
        ],
        "zip" => [
            "extensions" => ["zip", "rar", "tar"],
            "handler" => \Shofo\Media\Services\ZipFileService::class,
        ]
    ]
];
