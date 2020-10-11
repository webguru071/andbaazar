<?php

namespace App\Models;

use App\Models\District;
use App\Models\Union;
use Illuminate\Database\Eloquent\Model;

class Upzila extends Model
{
    protected $fillable = ['name','bn_name','slug','url','lat','lng','district_id'];

    public function district(){
        return $this->belongsTo(District::class, 'district_id');
      }
    public function union(){
      return $this->hasMany(Union::class,'upzila_id');
    }
}
