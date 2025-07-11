<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_master extends Model
{
    protected $table = '_user_master'; // Explicit table name

    protected $fillable = [
        'user_role',
        'username',
        'password',
    ];
}
