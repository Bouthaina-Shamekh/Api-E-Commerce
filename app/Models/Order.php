<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'copoun_id' , 'address_id' , 'total' , 'price','discount','status','payment status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function copoun()
    {
        return $this->belongsTo(Copoun::class ,'copoun_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function order_item()
    {
        return $this->hasMany(OrderItem::class);
    }

}
