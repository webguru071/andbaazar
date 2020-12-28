<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('valid_from');
            $table->string('valid_to');
            $table->integer('max_using_limit')->nullable();
            $table->integer('already_used')->nullable();
            $table->integer('single_user_max_using_limit')->nullable();
            $table->integer('min_order_amount')->nullable();
            $table->tinyInteger('discount_type')->default(0)->comment('O for flat discount amount, 1 for discount percentage');
            $table->integer('discount_amount');
            $table->integer('max_discount_amount')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 for active, 0 for inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_codes');
    }
}
