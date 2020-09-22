<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('parent_slug')->default(0);
            $table->string('parent_id')->default(0);
            $table->string('slug')->nullable()->unique();
            $table->string('thumb')->nullable();
            // $table->decimal('Percentage')->nullable();
            $table->decimal('percentage',8,2)->default(0.00);
            $table->integer('sort')->nullable();
            $table->enum('type',['ecommerce','sme','krishi'])->default('ecommerce');
            $table->integer('active')->default(1);
            $table->integer('is_last')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
