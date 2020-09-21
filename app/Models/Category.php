<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\InventoryAttribute;
use App\Models\Brand;
use App\Models\Auctionproduct;
use App\User;

class Category extends Model
{

    protected $fillable = ['name','desc','percentage','slug','thumb','parent','sort','parent_slug','parent_id','type','active','is_last','user_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
     return $this->belongsTo(HrmEmployee::class,'user_id');
   }
   public function itemcategory(){
     return $this->hasMany(ProductCategory::class,'category_id');
   }

    public function childs() {
        return $this->hasMany('App\Models\Category','parent_id','id') ;
    }

    public function item(){
       return $this->hasMany(Product::class,'category_id');
    }

    public function child()
    {
      return $this->hasMany('App\Models\Category', 'parent_id','id');
    }

    public function allChilds()
    {
        return $this->child()->with('allChilds');
    }

    public function inventoryAttributes(){
      return $this->belongsToMany(InventoryAttribute::class, 'inventory_attribute_category', 'category_id', 'inventory_attribute_id');
    }

    public function brands(){
      return $this->belongsToMany(Brand::class, 'brand_category', 'category_id', 'brand_id');
    }

    public function categoryAttr(){
      return $this->hasMany(Attribute::class,'category_id');
   }

   public function auctionProduct(){
    return $this->hasMany(Auctionproduct::class,'category_id');
 }


}
