<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->string('code')->nullable();
            $table->enum('agentship_plan',[
                'division_level',
                'district_level',
                'upazila_level',
                'union_level',
                'village_level',
                'municipal_level',
                'municipal_ward_level',
            ])->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender',['Male','Female','Other'])->default('Male');
            $table->string('slug')->nullable();
            $table->string('picture')->nullable();
            $table->foreignId('division_id')->constrained('divisions')->references('id')->onDelete('cascade');
            $table->integer('district_id');
            $table->enum('address_type',['Residential','Municipal']);
            $table->integer('municipal_id')->nullable();
            $table->integer('municipal_ward_id')->nullable();
            $table->integer('upazila_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->integer('village_id')->nullable();
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->string('nid')->nullable();
            $table->string('nid_img')->nullable();
            $table->text('description')->nullable();
            $table->text('rej_desc')->nullable();
            $table->date('last_visited_at')->nullable();
            $table->string('last_visited_from')->nullable();
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
        Schema::dropIfExists('agent_profile');
    }
}
