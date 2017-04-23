<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmed', 'confirmation_code', 'use_flag', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'user_lessons')->withPivot('result');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'user_categories')->withPivot('status');
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'user_levels')->withPivot('status');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getAvatarAttribute($avatar = null)
    {
        return isset($avatar) ? $avatar : config('common.user.default_avatar');
    }

    public function scopeConfirmationCode($query, $confirmationCode)
    {
        return $query->where('confirmation_code', $confirmationCode);
    }

     public function scopeUser($query)
    {
        return $query->where('role', config('common.user.role.user'));
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', config('common.user.role.admin'));
    }

    public function scopeUserEmail($query, $socialEmail)
    {
        return $query->where('email', $socialEmail);
    }

    public function isAdmin()
    {
        return $this->role == config('common.user.role.admin');
    }
}
