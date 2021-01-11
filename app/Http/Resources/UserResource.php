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
                'phone_no'      => $this->phone_no,
                'date_of_birth' => $this->customerDetails['dob'],
                'gender'        => $this->customerDetails['gender'],
                'picture'       => (!is_null($this->customerDetails['picture'])) ? $this->customerDetails['picture'] : 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxEPDhANDQ8PEA4NEA8ODw0PDQ8QEA8QFREWFhURExUYHSggGBolGxMTITEhJSkrLi4uFx8zODMtNygtLisBCgoKDQ0NDw0NDisZHxkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIAOEA4QMBIgACEQEDEQH/xAAaAAEAAwEBAQAAAAAAAAAAAAAAAgQFAQMH/8QAMhABAQABAgIHBwMEAwAAAAAAAAECAxEEIQUxQVFhgbESIjJxcpHBQlKhktHw8TNigv/EABUBAQEAAAAAAAAAAAAAAAAAAAAB/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A+qAKgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADy1eIxx67z7pzoPUZ2pxuV+HafzXjdbK/qy+9gNcZE1cv3Zf1VLHic5+r77UGqKOHHX9Unzl2XZZec5zvgOgAAAAAAAAAAAAAAAAAAAOW7Te8pO11Q6Q1Ocw7JzvzBHieKuXLHlj39tVgUAAAAE9LVuN3xvl2VABraGtM5vPOdz0ZnBZ7ZydmXKtNAAAAAAAAAAAAAAAAAAAY+rn7WVy72pr3bDL6b6MkABQAAAAAB3DLay91lbLFbMQdAAAAAAAAAAAAAAAAAB5cR8GX01lNfVm+OU75fRkAAKAAAAAUAa2jfcx+nH0ZLX0Z7uP0z0QTAAAAAAAAAAAAAAAAABW47UuOM2u292t8mY0ukJ7k+qelZ2wA65soOO7ADiQCIkAju0uB1blLLd9qztmh0dj7tvfl+IgtgAAAAAAAAAAAAAAAAA8eKx3wy+W/25sts2bza9V5M3iuH9jba7y7+QPABQAAAAAAanCY7YY+M3+6lwvD+3vbdpNvNpSbTadU5IOgAAAAAAAAAAAAAAAAAK3HY74b/tsv4WXMpvNr1XkDGE9bSuF2vle+IKAAAAAJ6On7WUxnne6Av8FhthP+3NYck25TsdQAAAAAAAAAAAAAAAAAAAAU+kZyxvjYorvSN5Yz51SAAUAAFvo7ry+U9VRa6PvvWd8/KDQAAAAAAAAAAAAAAAAAABzKyc7dp30HVPX43blhPO/iGtxsnLDn43qUbd+feCWedyu+V3qIKAAAADuOVl3l2vfHAFzR429Wc38Z1/ZdlYy5ocb2Zz/1PzEF4Rwzlm8u88EgAAAAAAAAAABDU1JjN8r/AHqlqcbb8M2nfedBoPLU18cevKfKc6zc9XK9eVvnyQBc1OO/bPO/2Vc9S5c8raiAAKAAAAAAAAAAO45WXeWy+C1p8dZ8U38ZyqoINTT4nHLt2vdeT2YqWGpZ1Wz5UGwM7T43KfFtlPtV3R1pn1ec7YD0AAAAQ1c5jjcr2fymo9I5fDj5/wCfyCrqalyu9/14IgoAAAAAAAAAAAAAAAAAAAAO45WXecrHAGrw+r7eO/b1WeL1Z3AZbZ7funp/laKAAAz+kPjn0z1oAqgKAAAAAAAAAAAAAAAAAAAAAAPbgv8Akx8/StQEAAH/2Q==',
                'description'   => $this->customerDetails['description'],
                'joining_date'  => $this->created_at->format('Y-m-d'),
            ]
        ];
    }
}
