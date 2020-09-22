<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->integer('name');
            $table->string('parent_slug')->default(0);
            $table->string('parent_id')->default(0);
            $table->string('slug')->nullable();        
            $table->text('description'); 

            $table->softDeletes();
            $table->unsignedBigInteger('user_id'); 
            
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
        Schema::dropIfExists('krishi_product_categories');
    }
}
