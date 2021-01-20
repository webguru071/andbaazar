<?php

namespace App\Models;

use App\Models\Geo\District;
use App\Models\Geo\Division;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'user_id',
        'division_id',
        'district_id',
        'zip_code',
        'address',
        'name',
        'phone',
        'address_type',
        'is_default_shipping',
        'is_default_billing'
    ];

    public function division(){
        return $this->belongsTo(Division::class,'division_id');
    }
    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
}
