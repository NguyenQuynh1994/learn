<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public $fillable = ['title', 'image', 'user_id', 'content', 'uses_flag'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
