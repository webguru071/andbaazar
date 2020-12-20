<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('qty');
            $table->string('unit')->nullable();
            $table->string('rate')->nullable();
            $table->text('amount');
            $table->boolean('active')->default(1)->change();
            $table->string('available_from');
            $table->string('frequency_support');
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders')->references('id')->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->references('id')->onDelete('cascade');
            $table->foreignId('krishi_product_id')->constrained('krishi_products')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('krishi_order_items');
    }
}
