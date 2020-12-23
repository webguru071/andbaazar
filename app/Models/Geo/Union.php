<?php

namespace App\Models\Geo;
use App\Models\Geo\Village;
use App\Models\Geo\District;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    protected $fillable = ['name','upazila_id','bn_name','url','lat','lng','slug'];
    
    public function village(){
        return $this->hasMany(Village::class);
    }
    public function district(){
        return $this->belongsTo(District::class, 'upazila_id');
    }
}
