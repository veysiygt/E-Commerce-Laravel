<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\HasApiTokens;
class Admin extends Model implements AuthenticatableContract
{
    use HasApiTokens, Authenticatable, HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'telephone',
        'email',
        'img',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

}
