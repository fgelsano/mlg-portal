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
            $table->string('applicant_img');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->integer('gender');
            $table->integer('civil_status');
            $table->string('religion');
            $table->integer('house_number')->nullable();
            $table->string('sitio')->nullable();
            $table->string('street_barangay');
            $table->string('municipality');
            $table->string('province');
            $table->integer('zip_code');
            $table->string('parent_guardian_name');
            $table->string('parent_guardian_contact');
            $table->string('school_graduated');
            $table->string('year_graduated');
            $table->text('school_address');
            $table->string('lrn');
            $table->string('course');
            $table->string('year_level');
            $table->string('sf9_front')->nullable();
            $table->string('sf9_back')->nullable();
            $table->string('gwa')->nullable();
            $table->string('gmc')->nullable();
            $table->string('psa_bc')->nullable();
            $table->string('med_cert')->nullable();
            $table->string('hd')->nullable();
            $table->integer('status');
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
