<?php

namespace Shofo\Media\Model;

use Illuminate\Database\Eloquent\Model;
use Shofo\Media\Services\MediaCoreService;

class Media extends Model
{
    protected $casts = [
        'files' => 'json'
    ];

    protected static function booted()
    {
        static::deleted(function ($media) {
            MediaCoreService::delete($media);
        });
    }

    public function getThumbAttribute()
    {
        return '/storage/Image/' . $this->files[100];
    }
}
