<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'nama_admin',
        'password',
        'last_login',
        'login_location'
    ];

    protected $guard = 'admin'; 
    protected $hidden = [
        'password',
    ];
}
