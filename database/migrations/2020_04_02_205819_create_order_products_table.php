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
            $table->decimal('qty',8,2)->default(0);
            $table->decimal('rate',8,2)->default(0);
            $table->decimal('amount',8,2)->default(0);
            $table->boolean('active')->default(1)->change();
            $table->foreignId('order_id')->constrained('orders')->references('id')->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->references('id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
            $table->foreignId('inventory_id')->constrained('inventories')->references('id')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->references('id')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->references('id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
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
