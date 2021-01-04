<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KrishiProductResource extends JsonResource
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
            'thumbnail_image' => $this->thumbnail_image,
            'description' => $this->description,
            'video_url' => $this->video_url,
            'available_from' => $this->available_from,
            'available_to' => $this->available_to,
            'available_stock' => $this->available_stock .$this->productUnit['symbol'],
        ];
    }
}
