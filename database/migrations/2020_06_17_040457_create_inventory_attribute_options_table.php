<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryAttributeOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_attribute_options', function (Blueprint $table) {
            $table->id();
            $table->string('option')->nullable();
            $table->unsignedBigInteger('inventory_attribute_id')->nullable();
            $table->foreign('inventory_attribute_id')->references('id')->on('inventory_attributes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('inventory_attribute_options');
    }
}
