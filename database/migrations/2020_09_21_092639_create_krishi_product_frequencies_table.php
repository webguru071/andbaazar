<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiProductFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_product_frequencies', function (Blueprint $table) {
            $table->bigIncrements('id');                     
            $table->string('day');

            $table->softDeletes();                            
            $table->unsignedBigInteger('product_id'); 
            $table->unsignedBigInteger('user_id'); 

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
        Schema::dropIfExists('krishi_product_frequencies');
    }
}