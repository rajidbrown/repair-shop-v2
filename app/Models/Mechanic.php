<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mechanic extends Authenticatable
{
    use Notifiable;

    protected $table = 'mechanics'; // Optional if table name matches plural model name

    protected $fillable = [
        'name',
        'email',
        'password',
        // Add more fields if needed
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}