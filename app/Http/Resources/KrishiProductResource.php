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

            // 'frequency_support'
            // 'available_stock'
            // 'price'
            // 'allow_wholesale'
            // 'wholesale_price'
            // 'min_wholesale_quantity'
            // 'allow_flash_sale'
            // 'flash_sale_discount_rate'
            // 'allow_custom_offer'
            // 'status'
            // 'total_views'
            // 'frequency'
            // 'frequency_quantity'
            // 'return_policy'
            // 'product_unit_id'
            // 'user_id'
            // 'category_id'
            // 'shop_id'
            // 'total_unit_sold'
            // 'total_order_no'

        ];
    }
}
