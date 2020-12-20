<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('review_msg');
            $table->string('stars');
            $table->text('reply_message');
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->references('id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('krishi_reviews');
    }
}
