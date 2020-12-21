<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KrishiProductItemImage extends Model
{
    protected $fillable=['product_id','sort','org_img','list_img','thumb_img','compressed_img','type'];
}
