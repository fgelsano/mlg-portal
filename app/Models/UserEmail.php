<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    protected $table = 'useremails';
    protected $fillable = [
        'user_id',
        'user_email',
        'email_password',
        'lms_password'
    ];
}
