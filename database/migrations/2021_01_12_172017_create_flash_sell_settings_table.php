<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashSellSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_sell_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('start_time',50);
            $table->string('end_time',50);
            $table->text('details')->nullable();
            $table->tinyInteger('status')->comment('0 for active, 1 for inactive');
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
        Schema::dropIfExists('flash_sell_settings');
    }
}
