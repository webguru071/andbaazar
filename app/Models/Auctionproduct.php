<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Category;
use App\Models\Merchant;

class Auctionproduct extends Model
{
    protected $fillable = ['name','slug','image','type','description','category_slug','qty','unit','category_id','merchant_id','user_id'];

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
        return $this->belongsTo(Merchant::class,'merchant_id');
    }
    public function itemimage(){
        return $this->hasMany(ItemImage::class,'product_id');
      }
}
