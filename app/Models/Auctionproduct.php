<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Category;
use App\Models\Shop;

class Auctionproduct extends Model
{
    protected $fillable = ['name','slug','email','image','type','status','description','category_slug','qty','unit','auctionproduct_id','category_id','merchant_id','user_id','shop_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function merchant(){
        return $this->belongsTo(MerchantProfile::class,'merchant_id');
    }
    public function shop(){
        return $this->belongsTo(MerchantProfile::class,'shop_id');
    }
    public function itemimage(){
        return $this->hasMany(ItemImage::class,'product_id');
      }
}
