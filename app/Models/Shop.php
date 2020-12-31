<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Merchant;
use App\Models\OrderItem;
use App\Models\Auctionproduct;
use App\User;

class Shop extends Model
{
  protected $fillable = [
    'name',
    'slogan',
    'slug',
    'phone',
    'logo',
    'lat',
    'lng',
    'address',
    'zip',
    'banner',
    'email',
    'web',
    'description',
    'bdesc',
    'facebook',
    'instagram',
    'twitter',
    'youtube',
    'active',
    'merchant_id',
    'user_id',
    'division_id',
    'district_id',
    'address_type',
    'municipal_id',
    'municipal_ward_id',
    'upazila_id',
    'union_id',
    'village_id'
];

  public function getRouteKeyName()
    {
        return 'slug';
    }

  public function user(){
    return $this->belongsTo(User::class,'user_id');
  }
  public function seller(){
    return $this->belongsTo(Merchant::class,'user_id','user_id');
  }
  public function cart(){
    return $this->hasMany(Cart::class,'shop_id');
 }
 public function orderitem(){
   return $this->hasMany(OrderItem::class,'shop_id');
 }
 public function auctionProduct(){
  return $this->hasMany(Auctionproduct::class,'shop_id');
}
}
