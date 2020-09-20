<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\Color;
use App\User;
use App\Models\Auctionproduct;

class ItemImage extends Model
{
  use SoftDeletes;
  protected $fillable = [
    'product_id',
    'color_slug',
    'type',
    'color_id',
    'sort',
    'org_img',
    'list_img',
    'thumb_img',
    'compressed_img',
    'active',
  ];

  public function product()
  {
      return $this->belongsTo(Product::class, 'product_id');
  }
  public function auctionproduct(){
    return $this->belongsTo(Auctionproduct::class,'product_id');
  }



  // public function color()
  // {
  //     return $this->belongsTo(Color::class, 'color_id');
  // }

}
