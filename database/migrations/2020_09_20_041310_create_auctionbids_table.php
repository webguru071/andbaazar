<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionbidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctionbids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('auction_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('auctionproduct_id');
            $table->string('rate');
            $table->text('message')->nullable();
            $table->boolean('autobid')->default(0)->change();
            $table->integer('autobid_increases')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('auctionproduct_id')->references('id')->on('auctionproducts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('auctionbids');
    }
}
