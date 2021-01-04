<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrishiBazarSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krishi_bazar_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('slider_image');
            $table->string('slider_url');
            $table->text('slider_details')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 for active, 0 for inactive');
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
        Schema::dropIfExists('krishi_bazar_sliders');
    }
}
