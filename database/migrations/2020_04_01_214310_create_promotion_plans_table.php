<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('from_price',8,0);
            $table->decimal('to_price',8,0);
            $table->decimal('amount',8,0);
            $table->string('slug')->nullable();
            $table->enum('is_free_shipping',['Yes','No'])->default('No');
            $table->boolean('active')->default(1)->change();
            $table->foreignId('promotion_id')->constrained('promotions')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('promotion_plans');
    }
}
