<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponCode extends Model
{
    use SoftDeletes;

    protected $fillable =['title', 'code', 'valid_from', 'valid_to', 'max_using_limit', 'already_used', 'single_user_max_using_limit', 'min_order_amount', 'discount_type', 'discount_amount', 'max_discount_amount', 'status'];
}
