<?php

namespace App\Models\Geo;
use App\Models\Geo\Union;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = ['name','bn_name','url','lat','lng','slug','union_id'];
    public function union(){
        return $this->belongsTo(Union::class, 'union_id');
      }
}
