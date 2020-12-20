<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('bn_name');
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('slug');
            $table->decimal('price',8,2)->default(0);
            $table->string('model_no')->nullable();
            $table->decimal('org_price',8,2)->default(0);
            $table->integer('pack_id')->nullable();
            $table->integer('sorting')->nullable();
            $table->enum('type',['sme','ecommerce'])->default('ecommerce');
            $table->text('description')->nullable();
            $table->text('bn_description')->nullable();
            $table->text('rej_desc')->nullable();
            // $table->integer('min_order')->nullable();
            $table->date('available_on')->nullable();
            $table->enum('availability',['Yes','No'])->default('Yes');
            // $table->string('availability');
            $table->string('made_in')->nullable();
            $table->string('materials')->nullable();
            $table->string('labeled')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('total_sale_amount')->nullable();
            $table->integer('total_order_qty')->nullable();
            $table->dateTime('last_ordered_at')->nullable();
            $table->dateTime('last_carted_at')->nullable();
            $table->integer('total_view')->nullable();
            $table->dateTime('activated_at')->nullable();
            $table->boolean('active')->default(1)->change();
            $table->enum('status',['Reject','Active','Pending'])->default('Pending');
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->references('id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->references('id')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->references('id')->onDelete('cascade');
            $table->text('category_slug')->nullable();
            $table->string('tag_slug')->nullable();
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
        Schema::dropIfExists('products');
    }
}
