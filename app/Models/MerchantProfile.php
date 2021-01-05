<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class MerchantProfile extends Model
{
    protected $table = 'merchant_profile';

    protected $fillable = [
        'user_id',
        'slug',
        'picture',
        'dob',
        'gender',
        'nid',
        'nid_img',
        'trad_img',
        'description',
        'last_visited_at',
        'last_visited_from',
        'reg_step'
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function shop(){
        return $this->hasMany(Shop::class,'merchant_id');
    }

    public function rejectvalue(){
        return $this->hasMany(RejectValue::class,'merchant_id');
    }
}
