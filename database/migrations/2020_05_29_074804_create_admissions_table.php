<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->string('academic_year')->comment('e.g. 2020-2021');
            $table->integer('semester')->comment('0=summer, 1=first_semester, 2=second_semester');
            $table->integer('status')->comment('0=pending, 1=accepted, 2=rejected, 3=enrolled');
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
        Schema::dropIfExists('admissions');
    }
}
