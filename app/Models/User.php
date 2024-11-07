<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    // Fillable fields for mass assignment
    protected $fillable = [
        'name', 'email', 'password', 'remember_token', // include other fields as needed
    ];

    // Hidden fields for serialization
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Casts for specific field types
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Ensures password is stored as a hashed value
    ];

    // For JWT Authentication
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
