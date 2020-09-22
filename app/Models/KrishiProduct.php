<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KrishiProduct extends Model
{
    protected $fillable = [
            'name', 
            'image',
            'email', 
            'description', 
            'video_url',  
            'date',  
            'frequency',     
            'category_slug', 
            'category_id', 
            'merchant_id', 
            'shop_id', 
            'user_id',    
    ];
}
