<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentProfile extends Model
{
    protected $table = 'agent_profile';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function shop(){
        return $this->hasOne(Shop::class,'agent_id');
    }
}
