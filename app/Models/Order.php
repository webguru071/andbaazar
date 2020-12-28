<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\CustomerBillingAddress;
use App\Models\Tag;
use App\Models\CustomerCard;
use App\Models\ShippingMethod;
use App\Models\BuyerPayment;
use App\Models\OrderItem;
use App\Models\PromotionUse;
use App\User;
class Order extends Model
{
    protected $fillable = ['order_number','invoice_number','tracking_number','subtotal','discount','shipping_cost','grand_total','admin_note','shipping_track','confirm_at','back_ordered_at','cancel_at','status','active','buyer_id','buyer_shipping_address_id','buyer_card_id','shipping_method_id','user_id'];

    public function user(){
     return $this->belongsTo(User::class,'user_id');
   }

    public function tag(){
      return $this->belongsTo(Customer::class,'customer_id');
    }

    public function buyerbilliadd(){
     return $this->belongsTo(CustomerBillingAddress::class,'customer_billing_address_id');
   }

    public function buyercard(){
      return $this->belongsTo(CustomerCard::class,'buyer_card_id');
    }

    public function shippingmethod(){
     return $this->belongsTo(ShippingMethod::class,'shipping_method_id');
   }

    // public function tag(){
    //   return $this->belongsTo(Tag::class,'tag_id');
    // }
    public function buyerpayment(){
      return $this->hasMany(BuyerPayment::class,'order_id');
    }
    public function orderitem(){
      return $this->hasMany(OrderItem::class,'order_id');
    }
    public function promotionuse(){
      return $this->hasMany(PromotionUse::class,'order_id');
    }

}
