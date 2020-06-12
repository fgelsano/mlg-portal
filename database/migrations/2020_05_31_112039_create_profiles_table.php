<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('school_id')->comment('e.g. yy-###### or no id yet');
            $table->string('profile_pic');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->integer('gender')->comment('1 = male | 2 = female');
            $table->integer('civil_status')->comment('1 = single | 2 = married | 3 = widow | 4 = widower');
            $table->string('contact_number');
            $table->string('religion');
            $table->string('purok')->nullable();
            $table->string('sitio')->nullable();
            $table->string('barangay');
            $table->string('municipality');
            $table->string('province');
            $table->integer('zipcode');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_number');
            $table->string('school_graduated');
            $table->string('year_graduated');
            $table->text('school_address');
            $table->string('lrn');
            $table->string('course')->comment('1=bsit, 2=beed, 3=bsed-math, 4=bsed-socstu');
            $table->string('year_level')->comment('1=first year, 2=second year, 3=third year, 4=fourth year');
            $table->integer('complete_profile')->comment('0=incomplete, 1=complete');
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
        Schema::dropIfExists('profiles');
    }
}
