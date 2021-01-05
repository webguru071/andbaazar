<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class RejectValue extends Model
{
    protected $fillable = ['rej_name','type','merchant_id','product_id','user_id'];

    public function merchant(){
     return $this->belongsTo(MerchantProfile::class,'merchant_id');
    }
    public function user(){
     return $this->belongsTo(User::class,'user_id');

    }
    public function item(){
        return $this->belongsTo(User::class,'product_id');

       }

}
