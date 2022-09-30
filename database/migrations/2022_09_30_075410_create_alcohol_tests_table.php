<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alcohol_tests', function (Blueprint $table) {
            $table->id();
            $table->string('gatename');
            $table->string('fullname_tested');
            $table->string('fullname_tester');
            $table->string('witness')->nullable();
            $table->string('sn_instrument');
            $table->dateTime('time');
            $table->string('result');
            $table->string('sn_instrument2');
            $table->string('result2');
            $table->string('smell_of_alcohol');
            $table->string('slurred_speech');
            $table->string('talkative');
            $table->string('unsteady_on_feet');
            $table->string('bloodshot_eyes');
            $table->string('Cooperative')->nullable();
            $table->string('observation')->nullable();
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
        Schema::dropIfExists('alcohol_tests');
    }
};
