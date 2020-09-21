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
   
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');                  
            $table->unsignedBigInteger('order_id'); 
            $table->unsignedBigInteger('shop_id');  
            $table->unsignedBigInteger('krishi_product_id');    
        
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('krishi_product_id')->references('id')->on('krishi_products')->onDelete('cascade')->onUpdate('cascade');           
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
