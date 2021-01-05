<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->string('picture')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender',['Male','Female','Other'])->nullable();
            $table->string('nid')->nullable();
            $table->string('nid_img')->nullable();
            $table->string('trad_img')->nullable();
            $table->text('description')->nullable();
            $table->date('last_visited_at')->nullable();
            $table->string('last_visited_from')->nullable();
            $table->enum('reg_step',['otp-varification','personal-info','shop-info','complete'])->default('otp-varification');
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
        Schema::dropIfExists('merchant_profile');
    }
}
