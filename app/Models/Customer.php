<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers';
    protected $primaryKey = 'CustomerID'; // Your actual primary key

    public $timestamps = true; // You have CreatedAt / UpdatedAt columns

    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'Password',
        'PhoneNumber',
        'Address',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    protected $casts = [
        'EmailVerifiedAt' => 'datetime',
    ];
}