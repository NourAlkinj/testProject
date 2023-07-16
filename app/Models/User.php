<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;    use HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'is_admin',
        'verification_code',
        'is_verified',




    ];
    protected $hidden =['created_at' , 'updated_at'];
    protected $casts = [
        'product_ids' => 'array'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'user_id');
    }
}
