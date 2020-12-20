<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->nullable();
            $table->string('picture')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender',['Male','Female','Other'])->nullable();
            $table->string('nid')->nullable();
            $table->string('nid_img')->nullable();
            $table->string('trad_img')->nullable();
            $table->text('description')->nullable();
            $table->date('last_visited_at')->nullable();
            $table->string('last_visited_from')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('remember_token')->nullable();
            $table->enum('status',['Active','Inactive','Reject'])->default('Inactive');
            $table->enum('reg_step',['otp-varification','personal-info','shop-info','complete'])->default('otp-varification');
            // $table->boolean('active')->default(1)->change();
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
        Schema::dropIfExists('merchants');
    }
}
