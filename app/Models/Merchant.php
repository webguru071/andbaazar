<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Shop;
use App\Models\RejectValue;
class Merchant extends Model
{
      protected $fillable = [
      'first_name',
      'last_name',
      'slug',
      'nid',
      'nid_img',
      'trad_img',
      'picture',
      'dob',
      'phone',
      'email',
      'gender',
      'description',
      'last_visited_at',
      'last_visited_from',
      'verification_token',
      'remember_token',
      'reg_step',
      'status',
      'rej_desc',
      'user_id'
    ];

      public function getRouteKeyName()
      {
          return 'slug';
      }

      public function user(){
       return $this->belongsTo(User::class,'user_id');
     }
     public function shop(){
       return $this->hasOne(Shop::class,'merchant_id');
     }

     public function rejectvalue(){
      return $this->hasMany(RejectValue::class,'merchant_id');
    }

}
