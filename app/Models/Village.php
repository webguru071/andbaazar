<?php

namespace App\Models;

use App\Models\Union;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = ['name','bn_name','slug','url','lat','lng','union_id'];

    public function union(){
        return $this->belongsTo(Union::class, 'union_id');
      }
}
