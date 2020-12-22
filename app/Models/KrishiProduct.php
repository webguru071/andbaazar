<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class KrishiProduct extends Model
{
    protected $fillable = [
            'name',
            'slug',
            'thumbnail_image',
            'description',
            'video_url',
            'available_from',
            'available_to',
            'frequency_support',
            'available_stock',
            'allow_custom_offer',
            'frequency',
            'return_policy',
            'product_unit_id',
            'category_id',
            'shop_id',
            'user_id',
    ];

    protected $casts =['frequency'=>'array'];

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
        return $this->belongsTo(Merchant::class,'merchant_id');
    }
    public function shop(){
        return $this->belongsTo(Merchant::class,'shop_id');
    }
    public function itemimage(){
        return $this->hasMany(KrishiProductItemImage::class,'product_id');
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
