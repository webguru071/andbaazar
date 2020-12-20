<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryAttributeCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_attribute_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->references('id')->onDelete('cascade');
            $table->foreignId('inventory_attribute_id')->constrained('inventory_attributes')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('inventory_attribute_category');
    }
}
