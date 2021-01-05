<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $table = 'customer_profile';

    protected $fillable = ['user_id','picture','dob','gender','description','last_visited_at','last_visited_from'];

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
