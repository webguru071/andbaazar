<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('email_verification_code')->nullable();
            $table->string('email_verification_code_expired_at')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_no_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('type',['customer','merchant','admin','agent'])->default('customer');
//            $table->enum('login_area',['krishibazar','ecommerce','auction','sme'])->nullable();
            $table->string('login_area')->nullable();
            $table->string('business_types')->nullable();
            $table->text('api_token')->nullable();
            $table->text('permissions')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 for pending, 1 for active, 2 for rejected');
            $table->string('verification_token')->nullable();
            $table->string('phone_otp')->nullable();
            $table->string('phone_otp_expired_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
