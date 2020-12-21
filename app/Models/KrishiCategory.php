<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KrishiCategory extends Model
{
    use SoftDeletes;
    protected $table ='krishi_product_categories';
    protected $fillable = ['name','slug','description','parent_slug','parent_id','user_id'];
}
