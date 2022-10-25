<?php

namespace Shofo\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Shofo\Media\Model\Media;
use Shofo\User\Models\User;

class Course extends Model
{
    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';

    static array $types = [
        self::TYPE_FREE,
        self::TYPE_CASH
    ];

    const STATUS_COMPLETE = 'complete';
    const STATUS_NOT_COMPLETE = 'not_complete';
    const STATUS_LOCKED = 'locked';

    static array $statuses = [
        self::STATUS_COMPLETE,
        self::STATUS_NOT_COMPLETE,
        self::STATUS_LOCKED
    ];

    const CONFIRMATION_ACCEPT = 'accept';
    const CONFIRMATION_REJECT = 'reject';

    static array $confirmation = [
        self::CONFIRMATION_ACCEPT,
        self::CONFIRMATION_REJECT,
    ];


    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'course_id', 'id');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }


}
