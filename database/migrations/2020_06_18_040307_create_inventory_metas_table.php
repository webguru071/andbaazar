<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->foreignId('inventory_id')->constrained('inventories')->references('id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
            // $table->unsignedBigInteger('inventory_attribute_id');

            // $table->foreign('inventory_attribute_id')->references('id')->on('inventory_attributes')->onDelete('cascade');

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
        Schema::dropIfExists('inventory_metas');
    }
}
