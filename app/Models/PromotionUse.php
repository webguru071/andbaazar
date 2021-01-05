<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Promotion;
use App\Models\Order;
use App\User;

class PromotionUse extends Model
{
    protected $fillable = ['title','amount','description','active','buyer_id','promotion_id','order_id','user_id'];

    public function user(){
     return $this->belongsTo(User::class,'user_id');
    }
    public function buyer(){
      return $this->belongsTo(CustomerProfile::class,'buyer_id');
    }
    public function order(){
     return $this->belongsTo(Order::class,'order_id');
    }
    public function promotion(){
      return $this->belongsTo(Promotion::class,'promotion_id');
    }
}
