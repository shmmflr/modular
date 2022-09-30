<?php

namespace Shofo\Course\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';

    static array $types = [self::TYPE_FREE, self::TYPE_CASH];

    const STATUS_COMPLETE = 'complete';
    const STATUS_NOT_COMPLETE = 'not_complete';
    const STATUS_LOCKED = 'locked';

    static array $statuses = [self::STATUS_COMPLETE, self::STATUS_NOT_COMPLETE, self::STATUS_LOCKED];


    protected $guarded = [];

}
