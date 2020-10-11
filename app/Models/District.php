<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Upzila;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name','bn_name','slug','url','lat','lng','division_id'];

    public function division(){
        return $this->belongsTo(Division::class, 'division_id');
      }

      public function upzila(){
        return $this->hasMany(Upzila::class,'district_id');
      }
}
