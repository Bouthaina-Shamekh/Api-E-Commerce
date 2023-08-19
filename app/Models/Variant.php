<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id' , 'image' , 'price' , 'discount'];




    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class , 'variant_attributes');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class , 'variant_attributes');
    }

    public function order_item()
    {
        return $this->hasMany(OrderItem::class);
    }
}
