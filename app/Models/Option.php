<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar' , 'title_en' , 'attribute_id','product_id'];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class  );
    }

}
