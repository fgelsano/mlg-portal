<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('description');
            $table->string('url');
            $table->integer('category');
            $table->integer('instructor');
            $table->integer('schedule');
            $table->integer('units');
            $table->integer('type')->comment('0=lecture, 1=lab');
            $table->integer('academic_year');
            $table->integer('semester')->comment('0=summer, 1=first semester, 2=second semester');
            $table->integer('status')->comment('0=availabe, 1=assigned, 3=completed');
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
        Schema::dropIfExists('subjects');
    }
}
