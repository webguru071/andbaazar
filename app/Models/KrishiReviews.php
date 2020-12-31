<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class KrishiReviews extends Model
{
    protected $fillable = [
        'stars',
        'review_msg',
        'parent_id',
        'images',
        'krishi_product_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function getChilds($id){
        return $this->where('parent_id',$id);
    }
}
