<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order;
use App\User;
class CustomerCard extends Model
{
  use SoftDeletes;
  protected $fillable = ['card_number','slug','card_holder_name','card_expire_date','card_cvc','active','customer_id','user_id','deleted_at'];

  public function user(){
   return $this->belongsTo(User::class,'user_id');
   }

   public function buyer(){
    return $this->belongsTo(CustomerProfile::class,'customer_id');
    }
    public function order(){
      return $this->hasMany(Order::class,'customer_card_id');
    }
}
