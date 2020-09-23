<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Shop;

class KrishiProduct extends Model
{
    protected $fillable = [
            'name',
            'slug', 
            'image',
            'email', 
            'description', 
            'video_url',  
            'date',  
            'frequency',     
            'category_slug', 
            'category_id', 
            'merchant_id', 
            'shop_id', 
            'user_id',    
    ];

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
    public function shop(){
        return $this->belongsTo(Merchant::class,'shop_id');
    }
    public function itemimage(){
        return $this->hasMany(ItemImage::class,'product_id');
      }
}
