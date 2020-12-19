<?php

namespace App;

use App\Models\Customer;
use App\Models\CustomerCard;
use App\Models\BuyerPayment;
use App\Models\CustomerShippingAddress;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Courier;
use App\Models\Inventory;
use App\Models\ProductCategory;
use App\Models\ItemImage;
use App\Models\ProductTag;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Promotion;
use App\Models\PromotionHead;
use App\Models\PromotionPlan;
use App\Models\PromotionUse;
use App\Models\Review;
use App\Models\Merchant;
use App\Models\ShippingMethod;
use App\Models\Shop;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Newsfeed;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
  use HasApiTokens;
    protected $fillable = [
        'first_name','last_name','type','email','mobile','password','api_token','login_area','business_types'
    ];
    protected $loginNames = ['email','type'];

    public function buyer(){
      return $this->hasMany(Customer::class,'user_id');
   }

     public function buyercard(){
       return $this->hasMany(CustomerCard::class,'user_id');
    }
      public function buyerpayment(){
        return $this->hasMany(BuyerPayment::class,'payment_method_id');
     }
     public function buyershippingadd(){
       return $this->hasMany(CustomerShippingAddress::class,'user_id');
    }

      public function cart(){
        return $this->hasMany(Cart::class,'user_id');
      }

      public function category(){
        return $this->hasMany(Category::class,'user_id');
      }
      public function color(){
        return $this->hasMany(Color::class,'user_id');
      }
      public function courier(){
        return $this->hasMany(Courier::class,'user_id');
      }
      public function inventory(){
        return $this->hasMany(Inventory::class,'user_id');
      }
      public function item(){
         return $this->hasMany(Product::class,'user_id');
      }
      public function itemcategory(){
        return $this->hasMany(ProductCategory::class,'user_id');
      }
      public function itemimage(){
        return $this->hasMany(ItemImage::class,'user_id');
      }
      public function itemtag(){
        return $this->hasMany(ProductTag::class,'user_id');
      }
      public function order(){
        return $this->hasMany(Order::class,'user_id');
      }
      public function orderitem(){
        return $this->hasMany(OrderItem::class,'user_id');
      }
      public function paymentmethod(){
        return $this->hasMany(PaymentMethod::class,'user_id');
      }
      public function promotion(){
        return $this->hasMany(Promotion::class,'user_id');
      }
      public function promotionhead(){
        return $this->hasMany(PromotionHead::class,'user_id');
      }
      public function promotionplan(){
        return $this->hasMany(PromotionPlan::class,'user_id');
      }
      public function promotionuse(){
        return $this->hasMany(PromotionUse::class,'user_id');
      }
      public function review(){
        return $this->hasMany(Review::class,'user_id');
      }
      public function seller(){
        return $this->hasMany(Merchant::class,'user_id');
      }
      public function shippingmethod(){
        return $this->hasMany(ShippingMethod::class,'user_id');
      }
      public function shop(){
        return $this->hasMany(Shop::class,'user_id');
      }
      public function size(){
        return $this->hasMany(Size::class,'user_id');
      }
      public function tag(){
        return $this->hasMany(Tag::class,'user_id');
      }
      public function brand(){
        return $this->hasMany(Brand::class,'user_id');
      }
      public function news(){
        return $this->hasOne(Newsfeed::class,'newsfeed_id');
      }
      protected $casts = ['business_types'=>'array'];
    }
