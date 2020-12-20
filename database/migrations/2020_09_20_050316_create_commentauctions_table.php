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
            $table->foreignId('auctionproduct_id')->constrained('auctionproducts')->references('id')->onDelete('cascade');
            $table->integer('parent_id')->nullable();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->text('comments');
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
        Schema::dropIfExists('commentauctions');
    }
}
