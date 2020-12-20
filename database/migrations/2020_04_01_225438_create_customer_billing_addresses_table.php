<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBillingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_billing_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location')->nullable();
            $table->string('slug')->nullable();
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('zip_code');
            $table->string('phone');
            $table->string('fax')->nullable();
            $table->boolean('active')->default(1)->change();
            $table->foreignId('customer_id')->constrained('customers')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('customer_billing_addresses');
    }
}
