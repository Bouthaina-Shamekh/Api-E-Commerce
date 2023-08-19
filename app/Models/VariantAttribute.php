<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['variant_id' , 'option_id' ,'attribute_id'];
    
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
    
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
