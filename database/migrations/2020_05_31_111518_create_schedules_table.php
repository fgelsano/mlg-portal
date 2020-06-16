<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->integer('type')->comment('0=room, 1=lab, 2=home');
            $table->string('day');
            $table->string('time');
            $table->integer('ay');
            $table->integer('sem')->comment('0=summer, 1=first, 2=second');
            $table->integer('status')->comment('0=available,1=taken');
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
        Schema::dropIfExists('schedules');
    }
}
