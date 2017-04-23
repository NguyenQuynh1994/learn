<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    public $fillable = ['user_id', 'lesson_word_id'];
}
