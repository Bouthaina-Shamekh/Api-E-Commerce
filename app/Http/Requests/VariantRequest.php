<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class VariantRequest extends FormRequest
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
            'product_id' => 'required',
            'image' => 'required',
            'price' => 'required',
            'discount' => 'required',

        ];
    }


    public function variantData()
    {
        $data = $this->validated();
        $data['user_id'] = Auth::user()->id;

        if (isset($data['image'])) {
            $name = Str::random(12);
            $image = $data['image'];
            $imageName = $name . time() . '_' . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/variants/', $imageName);
            $data['image'] = 'uploads/variants/' . $imageName;
        }
        return $data;
    }
}
