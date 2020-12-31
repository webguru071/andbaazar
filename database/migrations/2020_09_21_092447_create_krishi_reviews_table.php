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
            $table->string('stars')->nullable();
            $table->text('review_msg');
            $table->integer('parent_id')->default(0);
            $table->text('images')->nullable();
            $table->softDeletes();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->foreignId('krishi_product_id')->constrained('krishi_products')->references('id')->onDelete('cascade');
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
