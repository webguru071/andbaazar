<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Product;
use App\Models\NewsFeedComment;

class Newsfeed extends Model
{
    protected $fillable = ['image','title','slug','news_desc','rej_desc','status','user_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function item(){
        return $this->belongsTo(Product::class,'product_id');
    } 
    public function comments(){
        return $this->hasMany(NewsFeedComment::class,'news_feed_id');
    }
    public function onlyParentComments(){
        return $this->comments()->where('parent_id',0);
    }
}
