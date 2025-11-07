<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers';
    protected $primaryKey = 'CustomerID'; // Custom PK

    public $timestamps = true; // Matches CreatedAt / UpdatedAt

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

    /**
     * Tell Laravel which field to use for authentication.
     */
    public function getAuthIdentifierName()
    {
        return 'Email'; // exactly as it appears in the DB
    }

    /**
     * Override the default password column name.
     */
    public function getAuthPassword()
    {
        return $this->Password; // match your DB column name
    }
} 