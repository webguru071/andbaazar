<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'id'                => $this->id,
            'division_id'       => $this->division->id,
            'division_name'     => $this->division->name,
            'district_name'     => $this->district->name,
            'district_id'       => $this->district->id,
            'zip_code'          => $this->zip_code,
            'address'           => $this->address,
            'name'              => $this->name,
            'phone'             => $this->phone,
            'address_type'      => $this->address_type,
            'is_default_shipping'=> $this->is_default_shipping,
            'is_default_billing'=> $this->is_default_billing,
        ];
    }
}
