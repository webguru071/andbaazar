<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_number');
            $table->string('invoice_number');
            $table->string('tracking_number');
            $table->decimal('subtotal',8,2)->default(0);
            $table->decimal('discount',8,2)->default(0);
            $table->decimal('shipping_cost',8,2)->default(0);
            $table->decimal('grand_total',8,0)->default(0);
            $table->text('admin_note');
            $table->string('shipping_track');
            $table->dateTime('confirm_at');
            $table->dateTime('back_ordered_at');
            $table->dateTime('cancel_at');
            $table->enum('status',['Active','Voided'])->default('Active');
            $table->boolean('active')->default(1)->change();
            $table->foreignId('customer_id')->constrained('customers')->references('id')->onDelete('cascade');
            $table->foreignId('customer_billing_address_id')->constrained('customer_billing_addresses')->references('id')->onDelete('cascade');
            $table->foreignId('customer_shipping_address_id')->constrained('customer_shipping_addresses')->references('id')->onDelete('cascade');
            $table->foreignId('customer_card_id')->constrained('customer_cards')->references('id')->onDelete('cascade');
            $table->foreignId('shipping_method_id')->constrained('shipping_methods')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
