<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Merchant;

class RejectValue extends Model
{
    protected $fillable = ['rej_name','type','merchant_id','product_id','user_id']; 

    public function merchant(){
     return $this->belongsTo(Merchant::class,'merchant_id');
    }
    public function user(){
     return $this->belongsTo(User::class,'user_id');

    }
}
