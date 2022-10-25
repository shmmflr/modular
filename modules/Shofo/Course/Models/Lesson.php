<?php

namespace Shofo\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    const CONFIRMATION_ACCEPT = 'accept';
    const CONFIRMATION_REJECT = 'reject';
    const CONFIRMATION_LOCKED = 'locked';

    static array $confirmation = [
        self::CONFIRMATION_ACCEPT,
        self::CONFIRMATION_REJECT,
        self::CONFIRMATION_LOCKED,
    ];

    const CASH_ON = 'on';
    const CASH_OFF = 'off';

    static array $caching = [
        self::CASH_OFF,
        self::CASH_ON,
    ];

    protected $guarded = [];

}
