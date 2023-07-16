<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'master_image' => $this->master_image,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'price' => $this->price,
            'discount' => $this->discount,
            'general_info_ar' => $this->general_info_ar,
            'general_info_en' => $this->general_info_en,
            'specefications_ar' => $this->specefications_ar,
            'specefications_en' => $this->specefications_en,
            'status' => $this->status,
            'type' => $this->type,
            'attribute_id' => $this->attribute_id,
            'title_ar_attribute' => $this->attributes_title_ar,
            'title_en_attribute' => $this->attributes_title_en,
            'option_id' => $this->option_id,
            'title_ar_option' => $this->options_title_ar,
            'title_en_option' => $this->options_title_en,
        ];
    }
}
