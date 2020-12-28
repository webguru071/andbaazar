<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->text('description');
            $table->string('video_url')->nullable();
            $table->string('available_from')->nullable();
            $table->string('available_to')->nullable();
            $table->boolean('frequency_support')->default(1);
            $table->integer('available_stock')->nullable();
            $table->boolean('allow_custom_offer')->default(1);
            $table->enum('status',['Active','Pending','Reject'])->default('Pending');
            $table->integer('total_views')->nullable();
            $table->text('frequency')->nullable();
            $table->text('return_policy')->nullable();
            $table->unsignedBigInteger('product_unit_id');
            $table->foreign('product_unit_id')->references('id')->on('product_units')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('krishi_product_categories')->onDelete('cascade');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
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
        Schema::dropIfExists('krishi_products');
    }
}
