<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            // 'id' => $this->id,
            // 'status' => $this->status,
            // 'type' => $this->type,
            // 'attribute_id' => $this->attribute_id,
            // 'title_ar_attribute' => $this->attributes_title_ar,
            // 'title_en_attribute' => $this->attributes_title_en,
            // 'option_id' => $this->option_id,
            // 'title_ar_option' => $this->options_title_ar,
            // 'title_en_option' => $this->options_title_en,

            'id' => $this->id,
            'user_id' => $this->user_id,
            'copoun_id' => $this->copoun_id,
            'address_id' => $this->address_id,
            'total' => $this->total,
            'discount' => $this->discount,


        ];
    }
}
