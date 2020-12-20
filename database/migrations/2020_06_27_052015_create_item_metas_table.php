<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attr_label');
            $table->string('attr_value')->nullable();
            $table->foreignId('attribute_id')->constrained('attributes')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('item_metas');
    }
}
