<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGateKeeperLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_keeper_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session')->nullable();
            $table->dateTime('time');
            $table->integer('gate_keeper_id');
            $table->string('loginDevice')->nullable();
            $table->string('activity');
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
        Schema::dropIfExists('gate_keeper_logs');
    }
}
