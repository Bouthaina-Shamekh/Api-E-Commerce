<?php

namespace App\Models;

use App\Models\Order;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'phone',
        'otp',
        'status',
        'email',
        'type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'otp',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeChangeStatus()
    {
        if($this->status == "ACTIVE"){
            $this->update(['status' => 'INACTIVE']);
        }else{
            $this->update(['status' => 'ACTIVE']);
        }
    }


    public function roles(){
        return $this->belongsToMany(Role::class , 'role_users');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function permissions($permissions)
    {
        foreach($this->roles as $role){
            if(in_array($permissions ,  $role->permissions)){
                return true;
            }
            else{
                return false;
            }
        }
    }


}
