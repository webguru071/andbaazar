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
            $table->decimal('price',8,2)->default(0);
            $table->boolean('allow_wholesale')->default(0)->comment('1 for allowed, 0 for not allowed');
            $table->decimal('wholesale_price',8,2)->nullable()->default(0);
            $table->integer('min_wholesale_quantity')->nullable()->default(0);
            $table->boolean('allow_flash_sale')->default(1)->comment('1 for allowed, 0 for not allowed');
            $table->decimal('flash_sale_discount_rate',8,2)->nullable()->default(0);
            $table->boolean('allow_custom_offer')->default(0);
            $table->enum('status',['Active','Pending','Reject'])->default('Pending');
            $table->integer('total_views')->nullable();
            $table->text('frequency')->nullable();
            $table->integer('frequency_quantity')->nullable()->default(0);
            $table->text('return_policy')->nullable();
            $table->foreignId('product_unit_id')->constrained('product_units')->references('id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('krishi_product_categories')->references('id')->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->references('id')->onDelete('cascade');
            $table->integer('total_unit_sold')->default(0);
            $table->integer('total_order_no')->default(0);
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
