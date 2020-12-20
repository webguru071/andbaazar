<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('authorize_info');
            $table->integer('payment_token');
            $table->string('payer_info');
            $table->decimal('amount',8,2);
            $table->boolean('active')->default(1)->change();
            $table->foreignId('order_id')->constrained('orders')->references('id')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('payment_methods')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('buyer_payments');
    }
}
