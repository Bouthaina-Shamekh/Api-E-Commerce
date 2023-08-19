<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
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
            'address_id' => "required|exists:address,id",
             "total" => "required",
          //  "discount" => "required|numeric",
        ];
    }

    public function orderData()
    {
        $data = $this->validated();
        $data['user_id'] = Auth::guard('sanctum')->user()->id ?? NULL;
        return $data;
    }
}
