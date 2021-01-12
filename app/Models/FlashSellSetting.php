<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSellSetting extends Model
{
    protected $fillable = ['start_time', 'end_time', 'status'];

    protected $casts = ['start_time'=>'time', 'end_time'=>'time'];
}
