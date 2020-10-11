<?php

namespace App\Models;

use App\Models\Upzila;
use App\Models\Village;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    protected $fillable = ['name','bn_name','slug','url','lat','lng','upazila_id'];

    public function district(){
        return $this->belongsTo(District::class, 'upazila_id');
      }

      public function village(){
        return $this->hasMany(Village::class,'union_id');
      }
}
