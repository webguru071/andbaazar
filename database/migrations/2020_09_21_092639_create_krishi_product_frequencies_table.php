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
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('krishi_product_frequencies');
    }
}
