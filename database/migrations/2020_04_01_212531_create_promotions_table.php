<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('description');
            $table->enum('is_permanent',['Yes','No'])->default('Yes');
            $table->date('valid_from');
            $table->date('valid_to');
            $table->enum('has_coupon_code',['Yes','No'])->default('Yes');
            $table->string('coupon_code');
            $table->string('multiple_use')->nullable();
            $table->string('priority')->nullable();
            $table->boolean('active')->default(1)->change();
            $table->foreignId('promotion_head_id')->constrained('promotion_heads')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('promotions');
    }
}
