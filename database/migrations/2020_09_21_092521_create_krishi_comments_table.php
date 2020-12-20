<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comments');
            $table->foreignId('product_id')->constrained('products')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('parent_id');
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
        Schema::dropIfExists('krishi_comments');
    }
}
