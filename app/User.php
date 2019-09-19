<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * @const int
     */
    public const IS_BANNED = 1;

    /**
     * @const int
     */
    public const IS_ACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param $fields
     * @return User
     */
    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->email_verified_at = null;
        $user->banned = self::IS_ACTIVE;
        $user->remember_token = Str::random(100);
        $user->save();
        return $user;
    }

    /**
     * @param $user
     */
    public function toggleStatus(User $user)
    {
        if ($user->banned !== 0) {
            $user->banned = self::IS_ACTIVE;
        } else {
            $user->banned = self::IS_BANNED;
        }
        $user->save();
    }

    /**
     * @param $user
     */
    public function confirm(User $user)
    {
        $user->remember_token = null;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();
    }

    /**
     * @param $email
     * @return bool
     */
    public function isUserRegister(string $email)
    {
        return User::where('email', '=', $email)->exists();
    }

    /**
     * @param $name
     * @return bool
     */
    public function isUsernameInUse(string $name)
    {
        return User::where('name', '=', $name)->exists();
    }

    /**
     * @param $email
     * @return User
     */
    public function getUserByEmail(string $email)
    {
        return User::where('email', '=', $email)->firstOrFail();
    }
}
