<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;

class AttributeMeta extends Model
{
    protected $fillable = ['values', 'attribute_id'];

    public function attribute(){
        return $this->belongsTo(Attribute::class,'attribute_id');
    }

}
