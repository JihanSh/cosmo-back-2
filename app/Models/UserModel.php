<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class UserModel extends Authenticatable
{
    use
        Notifiable,
        HasApiTokens;
    protected $fillable = [
        'email',
        'Password',
        'FirstName',
        'LastName',
        'gender',
        'phone_number',
        'address',
        'apartment',
        'country',
        'city',
        'zip_code',
        ' token',
    ];
}
