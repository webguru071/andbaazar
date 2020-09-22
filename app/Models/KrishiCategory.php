<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KrishiCategory extends Model
{
    protected $fillable = ['name','slug','description','parent_slug','parent_id','user_id'];
}
