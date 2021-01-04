<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slogan')->nullable();
            $table->string('slug')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('address')->nullable();
            $table->string('zip')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('banner')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->text('description')->nullable();
            $table->text('bdesc')->nullable();
            $table->unsignedInteger('timezone_id')->nullable();
            $table->boolean('active')->default(1)->change();
            $table->foreignId('agent_id')->constrained('agents')->references('id')->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained('merchants')->references('id')->onDelete('cascade');
            $table->foreignId('division_id')->constrained('divisions')->references('id')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('districts')->references('id')->onDelete('cascade');
            $table->enum('address_type',['Residential','Municipal']);
            $table->integer('municipal_id')->nullable();
            $table->integer('municipal_ward_id')->nullable();
            $table->integer('upazila_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->integer('village_id')->nullable();
            $table->enum('type',['krishibazar','ecommerce','auction','sme','none'])->default('none');
            $table->enum('status',['Active','Inactive'])->default('Active');
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
        Schema::dropIfExists('shops');
    }
}
