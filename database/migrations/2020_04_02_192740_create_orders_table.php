<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('customer_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->foreignId('customer_billing_address_id')->constrained('customer_addresses')->references('id')->onDelete('cascade');
            $table->foreignId('customer_shipping_address_id')->constrained('customer_addresses')->references('id')->onDelete('cascade');
            $table->foreignId('shipping_method_id')->constrained('shipping_methods')->references('id')->onDelete('cascade');
            $table->integer('subtotal')->default(0);
            $table->integer('discount')->default(0);
            $table->foreignId('coupon_id')->nullable()->constrained('coupon_codes')->references('id')->onDelete('cascade');
            $table->integer('coupon_ discount')->default(0);
            $table->integer('tax_amount')->default(0);
            $table->integer('shipping_charge')->default(0);
            $table->integer('grand_total')->default(0);
            $table->string('order_type')->comment('krishi, ecommerce, auction, sme');
            $table->foreignId('order_tracking_stage_id')->nullable()->constrained('order_tracking_stages')->references('id')->onDelete('cascade');
            $table->tinyInteger('status')->default(0)->comment('0 pending, 1 approved, 3 rejected');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
