<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\ProductCategory;
use App\Models\ItemImage;
use App\Models\ItemMeta;
use App\Models\ProductTag;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\User;
use App\Models\Newsfeed;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
      'name',
      'bn_name',
      'image',
      'slug',
      'price',
      'model_no',
      'org_price',
      'pack_id',
      'sorting',
      'description',
       'email',
      'bn_description',
      'rej_desc',
      'min_order',
      'available_on',
      'availability',
      'made_in',
      'materials',
      'labeled',
      'video_url',
      'total_sale_amount',
      'total_order_qty',
      'last_ordered_at',
      'last_carted_at',
      'total_view',
      'brand_id',
      'activated_at',
      'active',
      'user_id',
      'shop_id',
      'category_id',
      'category_slug',
      'tag_slug',
       'status', 
       'type',

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

    public function color(){
      return $this->belongsTo(Color::class,'color_id');
    }

    public function pack(){
      return $this->belongsTo(HrmEmployee::class,'pack_id');
      }
      public function cart(){
        return $this->hasMany(cart::class,'product_id');
     }
     public function inventory(){
       return $this->hasMany(Inventory::class,'product_id');
     }
     public function itemcategory(){
       return $this->hasMany(ProductCategory::class,'product_id');
     }
     public function itemimage(){
       return $this->hasMany(ItemImage::class,'product_id');
     }
     public function itemtag(){
       return $this->hasMany(ProductTag::class,'product_id');
     }
     public function orderitem(){
       return $this->hasMany(OrderItem::class,'product_id');
     }
     public function review(){
       return $this->hasMany(Review::class,'product_id');
     } 
     public function item_meta(){
       return $this->hasMany(ItemMeta::class,'product_id');
     }
     public function news(){
      return $this->hasOne(Newsfeed::class,'product_id');
    }  

    public function rejectvalue(){
      return $this->hasMany(RejectValue::class,'product_id');
    }

     public static function getSubcategory($categoryId){
      return DB::table('categories')
                 ->select('id','name')
                 ->where('parent_id','=',$categoryId)
                 ->get();
    }

    public static function getSubcategoryChild($subCatId){
     return DB::table('categories')
                ->select('id','name','is_last','slug')
                ->where('parent_id','=',$subCatId)
                ->get();
   }

   public static function getChildCategory($childCatId){
     return DB::table('categories')
                ->select('id','name')
                ->where('parent_id','=',$childCatId)
                ->get();
   }

   public static function getChildCategory1($childCatid_1){
     return DB::table('categories')
                ->select('id','name')
                ->where('parent_id','=',$childCatid_1)
                ->get();
   }

   public static function getColorWiseImage($imgcolor){
     return DB::table('item_images')
            ->select('org_img')
            ->where('color_slug','!=','main')
            ->where('color_slug','=',$imgcolor)
            ->get();
   }

   public static function deleteInventory($productId){
     return DB::table('inventories')
             ->where('id','=',$productId)
             ->delete();
   }

   public static function getcategories($catvalue){
     return DB::table('categories')
               ->select('id','name')
               ->where('parent_id','=',0)
               ->where('type','=',$catvalue)
               ->get();
   }



      // public static function getColorWiseImage($imgcolor){
      //   return DB::table('item_images')
      //          ->select('org_img')
      //          ->where('color_slug','!=','main')
      //          ->where('color_slug','=',$imgcolor)
      //          ->get();
      // }




}
