<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->text('suggestion')->nullable();
            $table->enum('type',['multi-select','select','text','checkbox','radio','number'])->defult('text');
            $table->integer('required')->nullable();
            $table->integer('search_sidebar')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
