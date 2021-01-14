<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KrishiProductReviewCollection;
class KrishiProductReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $images = [];
        if($this->images){
            foreach(json_decode($this->images) as $img){
                array_push($images,asset($img));
            }
        }
        // dd($this->getChilds($this->id));
        // if($this->childs){
        //     $reviews = $this->childs
        // }
        return [
            'id'            => $this->id,
            'date'          => $this->created_at,
            'stars'         => $this->stars,
            'review_msg'    => $this->review_msg,
            'parent_id'     => $this->parent_id,
            'images'        => $images,
            'user_name'     => $this->user->first_name.' '.$this->user->last_name,
            'user_picture'  => asset('images/avatar-user.png'),
            'childs'        => new KrishiProductReviewCollection($this->getChilds($this->id)) //KrishiProductReviewResource::collection($this->collection)
        ];
    }
}
