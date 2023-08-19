<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copoun extends Model
{
    use HasFactory;

    protected $fillable = ['code' , 'discount' , 'status'];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function scopeChangeStatus()
    {
        if($this->status == "ACTIVE"){
            $this->update(['status' => 'INACTIVE']);
        }else{
            $this->update(['status' => 'ACTIVE']);
        }
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
