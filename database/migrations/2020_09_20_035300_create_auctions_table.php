<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('start_rate');
            $table->unsignedBigInteger('auctionproduct_id');
            $table->integer('winning_customer_id');
            $table->string('winning_rate');
            $table->enum('status',['running','complete','upcoming'])->default('running');
            $table->text('winning_customer_comment')->nullable();
            $table->text('seller_comment')->nullable();
            $table->integer('number_of_bids')->default(0);
            $table->unsignedBigInteger('order_id')->nullable();
            $table->timestamps(); 
            
            $table->foreign('auctionproduct_id')->references('id')->on('auctionproducts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions');
    }
}
