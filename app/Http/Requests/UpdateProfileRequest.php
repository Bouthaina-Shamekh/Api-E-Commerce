<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|numeric|unique:users,phone,' . Auth::user()->id,
        ];
    }

    public function profileData()
    {
        $data = $this->validated();
        $data['name'] = $data['first_name'] . " " . $data['last_name'];
        $data['password'] = Hash::make($data['phone']);
        $data['otp'] = Hash::make(mt_rand(1000, 9999));
        return $data;
    }
}
