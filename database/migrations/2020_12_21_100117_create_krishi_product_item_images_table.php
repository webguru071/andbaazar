<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiProductItemImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_product_item_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('krishi_products')->references('id')->onDelete('cascade');
            $table->integer('sort')->nullable();
            $table->text('org_img')->nullable();
            $table->text('list_img')->nullable();
            $table->text('thumb_img')->nullable();
            $table->text('compressed_img')->nullable();
            $table->boolean('active')->default(1)->change();
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
        Schema::dropIfExists('krishi_product_item_images');
    }
}
