<?php

namespace App\Models\Geo;
use App\Models\Geo\MunicipalWard;
use App\Models\Geo\District;
use Illuminate\Database\Eloquent\Model;

class Municipal extends Model
{
    protected $fillable = ['name','district_id','bn_name','url','lat','lng','slug'];

    public function wards(){
        return $this->hasMany(MunicipalWard::class);
    }

    public function district(){
        return $this->belongsTo(District::class, 'district_id');
    }
}
