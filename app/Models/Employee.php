<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
