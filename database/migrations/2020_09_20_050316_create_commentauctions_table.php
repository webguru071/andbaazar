<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentauctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentauctions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('auctionproduct_id');
            $table->integer('parent_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->text('comments');
            $table->timestamps();

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
        Schema::dropIfExists('commentauctions');
    }
}
