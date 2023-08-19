<?php

namespace App\Http\Requests;

use App\Models\Variant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            "product_id" => "required|exists:products,id",
            'cookie_id' =>  'required|string',
            "quantity" => "required|numeric",
            "color" => "required|string",
            "image" => "required|string",
            "price" => "required|numeric",
            "discount" => "required|numeric",
        ];
    }

    public function cartData()
    {
        $data = $this->validated();
        $data['user_id'] = Auth::guard('sanctum')->user()->id ?? NULL;
        $data['variant_id'] = Variant::where('product_id', $data['product_id'])->first()->id ?? NULL;
        return $data;
    }
}
