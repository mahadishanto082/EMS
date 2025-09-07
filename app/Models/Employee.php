<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    

    protected $table = 'employee';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'user_name',
        'date_of_birth',
        'phone_number',
        'password',
        'password_salt',
        'position',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',

    ];
}
