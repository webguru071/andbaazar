<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_uses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->decimal('amount',8,2)->default(0);
            $table->text('description');
            $table->boolean('active')->default(1)->change();
            $table->foreignId('buyer_id')->constrained('customers')->references('id')->onDelete('cascade');
            $table->foreignId('promotion_id')->constrained('promotions')->references('id')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('promotion_uses');
    }
}
