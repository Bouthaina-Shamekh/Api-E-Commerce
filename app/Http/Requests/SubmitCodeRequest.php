<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitCodeRequest extends FormRequest
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
        $rules = [
            'email' => 'required|email|exists:users,email',
            'phone' => 'required|numeric|exists:users,phone',
            'fcm_token' => 'required|string',
            'device_name' => 'required|string',
            'otp' => 'required|numeric|digits:4',
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
}
