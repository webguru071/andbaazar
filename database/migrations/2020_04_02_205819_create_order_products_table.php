<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained('orders')->references('id')->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->references('id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->foreignId('inventory_id')->nullable()->constrained('inventories')->references('id')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('total_price');
            $table->foreignId('agent_id')->nullable()->constrained('users')->references('id')->onDelete('cascade');
            $table->tinyInteger('status')->default(0)->comment('0 pending, 1 deliveried, 2 refund, 3 rejected');
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
        Schema::dropIfExists('order_products');
    }
}
