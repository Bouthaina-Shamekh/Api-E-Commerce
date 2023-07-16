<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar' , 'title_en' , 'status'];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }
}
