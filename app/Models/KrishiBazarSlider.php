<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class KrishiBazarSlider extends Model
{
    protected $fillable = ['slider_image', 'slider_url', 'slider_details', 'status'];

    public function getSliderImageAttribute($slider_image)
    {
        return Storage::url($slider_image);
    }
}

