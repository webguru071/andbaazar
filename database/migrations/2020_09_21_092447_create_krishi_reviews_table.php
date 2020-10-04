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
            $table->unsignedBigInteger('user_id');                  
            $table->unsignedBigInteger('customer_id'); 
            $table->unsignedBigInteger('product_id');  
                     
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');          
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');           
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');         
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
