<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('rate',8,2);
            $table->decimal('qty',8,2);
            $table->boolean('active')->default(1)->change();
            $table->foreignId('customer_id')->constrained('customers')->references('id')->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->references('id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
            $table->foreignId('inventory_id')->constrained('inventories')->references('id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('carts');
    }
}
