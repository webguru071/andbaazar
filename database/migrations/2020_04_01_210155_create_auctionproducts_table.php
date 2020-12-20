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
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->enum('type',['krishi','other'])->default('other');
            $table->text('description');
            $table->string('slug')->nullable();
            $table->boolean('sold')->default(0)->change();
            $table->string('qty');
            $table->string('unit');
            $table->enum('status',['Active','Reject','Pending'])->default('Pending');
            $table->text('category_slug')->nullable();
            $table->foreignId('category_id')->constrained('categories')->references('id')->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained('merchants')->references('id')->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->references('id')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('auctionproducts');
    }
}
