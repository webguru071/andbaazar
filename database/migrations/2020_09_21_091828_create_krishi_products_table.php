<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_products', function (Blueprint $table) {
            $table->bigIncrements('id');                     
            $table->integer('name');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('description');
            $table->string('video_url');
            $table->string('available_from');
            $table->string('frequency_support');
            $table->text('available_stock');
            $table->string('allow customer offer');
            $table->string('status');
            $table->string('view');
            $table->date('date');  

            $table->softDeletes();
            $table->unsignedBigInteger('user_id');                  
            $table->unsignedBigInteger('merchant_id'); 
            // $table->unsignedBigInteger('krishi_category_product_id');    
        
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('krishi_category_product_id')->references('id')->on('krishi_product_categories')->onDelete('cascade')->onUpdate('cascade');           
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
        Schema::dropIfExists('krishi_products');
    }
}
