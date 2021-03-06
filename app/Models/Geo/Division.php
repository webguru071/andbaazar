<?php

namespace App\Models\Geo;
use App\Models\Geo\District;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['name','bn_name','url','lat','lng','slug'];

    public function district(){
        return $this->hasMany(District::class);
    }
}
