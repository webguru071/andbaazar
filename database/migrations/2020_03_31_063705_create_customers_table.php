<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //Schema::dropIfExists('customers');
      Schema::create('customers', function (Blueprint $table) {
           $table->bigIncrements('id');
          $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
           $table->string('first_name')->nullable();
           $table->string('last_name')->nullable();
           $table->string('phone')->nullable();
           $table->string('picture')->nullable();
           $table->date('dob')->nullable();
           $table->enum('gender',['Male','Female','Other'])->nullable();
           $table->text('description')->nullable();
           $table->date('last_visited_at')->nullable();
           $table->string('last_visited_from')->nullable();
           $table->string('verification_token')->nullable();
           $table->string('remember_token')->nullable();
           $table->boolean('active')->default(1)->change();
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
        Schema::dropIfExists('customers');
    }
}
