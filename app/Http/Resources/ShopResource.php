<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'email' => $this->email,
            'slug' => $this->slug,
            'slogan' => $this->slogan,
            'logo' => (!is_null($this->logo)) ? asset($this->logo) : asset('images/avatar-shop.png'),
            'phone_no' => $this->phone,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'address' => $this->address,
            'zip_code' => $this->zip,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'banner' => $this->banner,
            'web_address' => $this->web,
            'description' => $this->description,
            'bdesc' => $this->bdesc,
        ];
    }
}
