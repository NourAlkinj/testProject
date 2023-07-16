<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'description',
        'user_id'
    ];
    protected $hidden =['created_at' , 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
