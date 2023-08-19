<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'street' , 'region' , 'city' , 'zip_code' , 'note' , 'user_id'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
