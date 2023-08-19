<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
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
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            "category_id" => "required|numeric",
            'description_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'general_info_ar' => 'required|string|max:255',
            'general_info_en' => 'required|string|max:255',
            'specefications_ar' => 'required|string|max:255',
            'specefications_en' => 'required|string|max:255',
              'master_image' =>  $this->getMethod() === 'POST' ? 'required' : 'nullable',
            'status' => 'required|in:ACTIVE,INACTIVE',
            'type' => 'required|in:ALL,NEW,MOSTWATCHED,MOSTBOUGHT',
            "price" => "required|numeric",
            "discount" => "required|numeric",
            'attrr'=>'array'
        ];
    }

    public function productData()
    {
        $data = $this->validated();
        if (isset($data['master_image'])) {
            $name = Str::random(12);
            $image = $data['master_image'];
            $imageName = $name . time() . '_' . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/Products/', $imageName);
            $data['master_image'] = 'uploads/Products/' . $imageName;
        }

        // if (isset($data['master_image'])) {
        //     $name = Str::random(12);
        //     $master_image = $data['master_image'];
        //     $imageName = $name . time() . '_' . '.' . $master_image->getClientOriginalExtension();
        //     $master_image->move('uploads/Products/', $imageName);
        //     $data['master_image'] = 'uploads/Products/' . $imageName;
        // }
        return $data;
    }
}
