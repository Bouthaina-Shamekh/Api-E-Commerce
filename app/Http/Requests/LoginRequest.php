<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
            'phone' => 'required|numeric|exists:users,phone',
        ];
        if ($this->filled('email')) {
            unset($rules['phone']);
        } else {
            $rules['email'] = 'required|numeric|exists:users,email';
        }
        if ($this->filled('phone')) {
            unset($rules['email']);
        } else {
            $rules['phone'] = 'required|numeric|exists:users,phone';
        }
        return $rules;
    }

    public function loginData()
    {
        $data = $this->validated();
        $data['otp'] = Hash::make(mt_rand(1000, 9999));
        return $data;
    }
}
