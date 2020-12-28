<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTrackingStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_tracking_stages', function (Blueprint $table) {
            $table->id();
            $table->string('stage_name');
            $table->tinyInteger('order')->unique();
            $table->tinyInteger('status')->default(1)->comment('1 is for active, 0 is for inactive');
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
        Schema::dropIfExists('order_tracking_stages');
    }
}
