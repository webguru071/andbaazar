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
            'thumbnail_image' => (!is_null($this->thumbnail_image)) ? asset($this->thumbnail_image) : asset('images/avatar-product.png'),
            'description' => $this->description,
            'video_url' => $this->video_url,
            'available_from' => $this->available_from->format('Y-m-d'),
            'available_to' => $this->available_to->format('Y-m-d'),
            'available_stock' => $this->available_stock .$this->productUnit['symbol'],
            'frequency_support' => $this->frequency_support,
            'frequency' => $this->frequency,
            'frequency_quantity' => $this->frequency_quantity,
            'price' => $this->price,
            'unit' => $this->productUnit->symbol,
            'allow_wholesale' => $this->allow_wholesale,
            'wholesale_price' => $this->wholesale_price,
            'min_wholesale_quantity' => $this->min_wholesale_quantity,
            'return_policy' => $this->return_policy,
            'total_unit_sold' => $this->total_unit_sold,
            'shop' => $this->shop->name,
            'images' => new KrishiProductImageCollection($this->itemimage),
            'flash_sale_discount_price' => (float)$this->flash_sale_discount_rate,
        ];
    }
}
