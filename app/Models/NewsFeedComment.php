<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Newsfeed;
use App\User;

class NewsFeedComment extends Model
{
    protected $fillable = [
        'news_feed_id',
        'user_id',
        'parent_id',
        'comments'
    ];

    public function newsFeed(){
        return $this->belongsTo(Newsfeed::class,'news_feed_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function getChilds($id){
        return $this->where('parent_id',$id);
    }

    
}
