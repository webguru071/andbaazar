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
            $table->foreignId('auction_id')->constrained('auctions')->references('id')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->references('id')->onDelete('cascade');
            $table->foreignId('auctionproduct_id')->constrained('auctionproducts')->references('id')->onDelete('cascade');
            $table->string('rate');
            $table->text('message')->nullable();
            $table->boolean('autobid')->default(0)->change();
            $table->integer('autobid_increases')->nullable();
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
        Schema::dropIfExists('auctionbids');
    }
}
