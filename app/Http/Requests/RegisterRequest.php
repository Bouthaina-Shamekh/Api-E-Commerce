<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
        ];
    }

    public function registerData()
    {
        $data = $this->validated();
        $data['name'] = $data['first_name'] . " " . $data['last_name'];
        $data['password'] = Hash::make($data['phone']);
        $data['otp'] = Hash::make(mt_rand(1000, 9999));
        return $data;
    }
}
