<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Product;
use App\User;
class Review extends Model
{
      protected $fillable = ['stars','reply','review_msg','active','buyer_id','item_id','user_id'];

      public function user(){
       return $this->belongsTo(User::class,'user_id');
      }
      public function buyer(){
        return $this->belongsTo(Customer::class,'buyer_id');
      }
      public function item(){
        return $this->belongsTo(Product::class,'item_id');
      }
}
