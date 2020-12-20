<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
            $table->string('color_slug')->default('main');
            $table->foreignId('color_id')->default(0)->constrained('colors')->references('id')->onDelete('cascade');
            $table->integer('sort')->nullable();
            $table->text('org_img')->nullable();
            $table->text('list_img')->nullable();
            $table->text('thumb_img')->nullable();
            $table->text('compressed_img')->nullable();
            $table->string('type')->nullable();
            $table->boolean('active')->default(1)->change();
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('auctionproduct_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->foreign('auctionproduct_id')->references('id')->on('auctionproducts')->onDelete('cascade');
            // $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_images');
    }
}
