<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;

class Admin extends Model
{
    protected $fillable = ['name', 'email', 'password', 'avatar'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getAvatarAttribute($avatar = null)
    {
        return isset($avatar) ? $avatar : config('common.user.default_avatar');
    }
}
