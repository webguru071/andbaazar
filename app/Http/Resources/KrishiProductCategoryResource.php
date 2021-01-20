<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KrishiProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'product'   => $this->productqty,
            'thumbnail_image' => (!is_null($this->thumbnail_image)) ? asset($this->thumbnail_image) : asset('images/avatar-product.png'),
        ];
    }
}
