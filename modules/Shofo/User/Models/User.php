<?php

namespace Shofo\User\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Shofo\Course\Models\Course;
use Shofo\Course\Models\Section;
use Shofo\Media\Model\Media;
use Shofo\RolePermission\Models\Role;
use Shofo\User\Notifications\ResetPasswordRequestNotification;
use Shofo\User\Notifications\VerifyEmailNotification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVE = 'de_active';
    const STATUS_BAN = 'ban';

    public static array $statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_DEACTIVE,
        self::STATUS_BAN
    ];


    public static array $adminUser = [
        [
            'name' => 'admin',
            'password' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => Role::ROLE_SUPER_ADMIN,

        ]
    ];

    protected $fillable = [
        'name',
        'username',
        'email',
        'mobile',
        'password',
        'bio',
        'telegram',
        'instagram',
        'linkdin',
        'youtube',
        'twitter',
        'status',
        'image_id',
        'ip',
        'shaba',
        'card_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendResetPasswordRequestNotification()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id', 'id');

    }

    public function userName()
    {
        return $this->username ?
            route('view.profile', $this->username) :
            route('view.profile', 'username');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
