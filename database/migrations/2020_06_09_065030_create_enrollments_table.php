<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->integer('subject_id');
            $table->integer('course')->comment('0=bsit, 1=beed, 2=bsed-math, 3=bsed-socstu');
            $table->integer('year_level')->comment('1=first year, 2=second year, 3=third year, 4=fourth year');
            $table->integer('status')->comment('0=active, 1=completed, 2=inc, 3=no-grade, 4=failed, 5=dropped, 6=cancelled');
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
        Schema::dropIfExists('enrollments');
    }
}
