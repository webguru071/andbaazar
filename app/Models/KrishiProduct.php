<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Category;
use App\Models\Shop;
use App\Models\KrishiReviews;
use Illuminate\Support\Facades\DB;

class KrishiProduct extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'thumbnail_image',
        'description',
        'video_url',
        'available_from',
        'available_to',
        'frequency_support',
        'available_stock',
        'price',
        'allow_wholesale',
        'wholesale_price',
        'min_wholesale_quantity',
        'allow_flash_sale',
        'flash_sale_discount_rate',
        'allow_custom_offer',
        'status',
        'total_views',
        'frequency',
        'frequency_quantity',
        'return_policy',
        'product_unit_id',
        'user_id',
        'category_id',
        'shop_id',
        'total_unit_sold',
        'total_order_no'
    ];

    protected $casts =['frequency'=>'array', 'available_from'=>'date', 'available_to'=>'date'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(KrishiCategory::class,'category_id');
    }
    public function merchant(){
        return $this->belongsTo(MerchantProfile::class,'merchant_id');
    }
    public function shop(){
        return $this->belongsTo(MerchantProfile::class,'shop_id');
    }
    public function itemimage(){
        return $this->hasMany(KrishiProductItemImage::class,'product_id');
    }
    public function reviews(){
        return $this->hasMany(KrishiReviews::class,'krishi_product_id');
    }
    public function onlyParentReviews(){
        return $this->reviews()->where('parent_id',0);
    }

    public function productUnit(){
        return $this->belongsTo(ProductUnit::class,'product_unit_id');
    }
    public static function getSubcategoryChild($subCatId){
        return DB::table('krishi_product_categories')
            ->select('id','name','is_last','slug')
            ->where('parent_id','=',$subCatId)
            ->get();
    }
}
