<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctionproducts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('images');
            $table->enum('type',['krishi','other'])->default('other');
            $table->text('description');
            $table->string('slug')->nullable();
            $table->boolean('sold')->default(0)->change();
            $table->string('qty');
            $table->string('unit'); 
            $table->text('category_slug')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctionproducts');
    }
}
