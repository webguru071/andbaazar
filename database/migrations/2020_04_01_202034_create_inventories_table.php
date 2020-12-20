<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->foreignId('color_id')->nullable()->constrained('colors')->references('id')->onDelete('cascade');
            $table->string('color_name')->nullable();
            $table->integer('qty_stock');
            $table->decimal('price',8,2)->default(0);
            $table->decimal('special_price',8,2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('seller_sku')->nullable();
            $table->integer('sort')->nullable();
            $table->foreignId('shop_id')->nullable()->constrained('shops')->references('id')->onDelete('cascade');
            $table->string('available_on')->nullable();
            $table->enum('type',['ecommerce','sme']);
            $table->boolean('active')->default(1)->change();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('inventories');
    }
}
