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
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->text('description');
            $table->string('video_url')->nullable();
            $table->enum('type',['krishi','other'])->default('krishi');
            $table->string('available_from')->nullable();
            $table->boolean('frequency_support')->default(1)->change();
            $table->text('available_stock')->nullable();
            $table->string('allow_customer_offer')->nullable();
            $table->enum('status',['Active','Pending','Reject'])->default('Pending');
            $table->string('view')->nullable();
            $table->date('date'); 
            $table->string('frequency')->nullable(); 
            $table->text('category_slug')->nullable();

            $table->softDeletes();
            $table->unsignedBigInteger('user_id');                  
            $table->unsignedBigInteger('merchant_id'); 
            $table->unsignedBigInteger('category_id')->nullable();  
            $table->unsignedBigInteger('shop_id');

            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade')->onUpdate('cascade');          
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');           
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
