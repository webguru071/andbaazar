<?php

namespace App\Models;


use App\Models\District;
use Illuminate\Database\Eloquent\Model;

class Municipal extends Model
{
    protected $fillable = ['name','bn_name','slug','url','lat','lng','district_id'];

    public function district(){
        return $this->belongsTo(District::class, 'district_id');
      }
}
