<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'error' => false,
            'msg'   => 'success',
            'data'  => [
                'id'            => $this->id,
                'first_name'    => $this->first_name,
                'last_name'     => $this->last_name,
                'email'         => $this->email,
                'phone_no'      => $this->phone,
                'date_of_birth' => $this->customerDetails['dob'],
                'gender'        => $this->customerDetails['gender'],
                'picture'       => (!is_null($this->customerDetails['picture'])) ? asset($this->customerDetails['picture']) : asset('images/avatar-user.png'),
                'description'   => $this->customerDetails['description'],
                'joining_date'  => $this->created_at->format('Y-m-d'),
            ]
        ];
    }
}
