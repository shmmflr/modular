<?php

namespace Shofo\Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shofo\User\Models\User;

class Section extends Model
{
    use HasFactory;

    const CONFIRMATION_ACCEPT = 'accept';
    const CONFIRMATION_REJECT = 'reject';

    static array $confirmation = [
        self::CONFIRMATION_ACCEPT,
        self::CONFIRMATION_REJECT,
    ];

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
