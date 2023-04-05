<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Customer extends Model implements AuthenticatableContract
{
    use HasApiTokens, Authenticatable, HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'telephone',
        'email',
        'img',
        'password',
        'identity_number',
        'mother_name',
        'father_name',
        'gender',
        'place_of_birth',
        'birth_date',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
    
}
