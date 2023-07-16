<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar' , 'title_en' , 'master_image' , 'description_ar' , 'description_en' , 'price' ,
    'discount' , 'general_info_ar' , 'general_info_en' , 'specefications_ar' , 'specefications_en' , 'status' , 'type' , 'category_id'];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new ActiveScope);
    // }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function user_review(){
        return $this->hasOne(Review::class)->where('user_id' , Auth::user()->id ?? "");
    }

    public function user_favorite()
    {
        return $this->hasOne(Favorite::class)->where('user_id', Auth::user()->id ?? "");
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function product_attribute()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class , 'product_attributes');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $filters = array_merge([
            'name' => null,
            'type' => null,
            'category' => null,
            'from' => null,
            'to' => null,
            'myFavorite' => null,
        ], $filters);

        $builder->when($filters['name'], function ($builder, $value) {
            $builder->where('title_ar', 'like', '%' . $value . '%')
                ->orWhere('title_en', 'like', '%' . $value . '%');
        });

        $builder->when($filters['type'], function ($builder, $value) {
            $builder->where('type', $value);
        });

        $builder->when($filters['category'], function ($builder, $value) {
            $builder->where('category_id' , $value);
        });

        $builder->when($filters['from'], function ($builder, $value) {
            $builder->where('price', '>=', $value);
        });

        $builder->when($filters['to'], function ($builder, $value) {
            $builder->where('price', '<=', $value);
        });

        $builder->when($filters['myFavorite'], function ($q) {
            $q->whereHas('favorites', function ($q) {
                $q->where('user_id', Auth::user()->id);
            });
        });
    }
}
