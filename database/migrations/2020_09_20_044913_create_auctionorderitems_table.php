<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionorderitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctionorderitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained('orders')->references('id')->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->references('id')->onDelete('cascade');
            $table->foreignId('auctionproduct_id')->constrained('auctionproducts')->references('id')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('unit');
            $table->integer('rate');
            $table->integer('amount');
            $table->boolean('active')->default(1)->change();
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
        Schema::dropIfExists('auctionorderitems');
    }
}
