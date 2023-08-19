<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar' , 'title_en'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class , 'product_attributes');
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class , 'variant_attributes');
    }
}
