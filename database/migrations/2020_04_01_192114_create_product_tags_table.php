<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('tag_id')->nullable()->constrained('tags')->references('id')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->references('id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('product_tags');
    }
}
