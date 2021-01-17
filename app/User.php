<?php

namespace App;

use App\Models\AgentProfile;
use App\Models\CustomerProfile;
use App\Models\CustomerCard;
use App\Models\BuyerPayment;
use App\Models\CustomerShippingAddress;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Courier;
use App\Models\Inventory;
use App\Models\MerchantProfile;
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
use App\Models\ShippingMethod;
use App\Models\Shop;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Newsfeed;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable, SoftDeletes;
    protected $fillable = [
      'first_name',
      'last_name',
      'email',
      'email_verified_at',
      'phone',
      'phone_no_verified_at',
      'password',
      'type',
      'login_area',
      'login_area',
      'business_types',
      'api_token',
      'permissions',
      'last_login',
      'status',
      'verification_token',
      'phone_otp',
      'phone_otp_expired_at'
    ];

    protected $loginNames = ['email','type'];

    public function routeNotificationForTwilio(){
      // return '+88'.$this->phone; 
      return '+8801969516500';
      // return '+8801882453300';
    }

    public function customerDetails(){
        return $this->hasOne(CustomerProfile::class,'user_id','id');
    }

    public function merchantDetails(){
        return $this->hasOne(MerchantProfile::class,'user_id','id');
    }

    public function agentDetails(){
        return $this->hasOne(AgentProfile::class,'user_id','id');
    }

    public function buyer(){
      return $this->hasMany(CustomerProfile::class,'user_id');
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
        return $this->hasMany(MerchantProfile::class,'user_id');
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
      protected $casts = ['business_types'=>'array', 'phone_otp_expired_at'=>'datetime', 'email_verified_at'=>'datetime', 'email_verification_code_expired_at'=>'datetime'];
    }
