<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['name','bn_name','slug','url','lat','lng'];

    public function district(){
        return $this->hasMany(District::class,'division_id');
      }
}
