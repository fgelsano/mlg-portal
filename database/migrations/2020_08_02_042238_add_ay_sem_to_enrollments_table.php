<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAySemToEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $checkAy = Schema::hasColumn('enrollments','academic_year');
        $checkSem = Schema::hasColumn('enrollments','semester');

        if(!$checkAy){
            if(!$checkSem){
                Schema::table('enrollments', function (Blueprint $table) {
                    $table->integer('academic_year')->after('year_level');
                    $table->integer('semester')->after('academic_year')->comment('0=summer, 1=first semester, 2=second semester');            
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn('academic_year');
            $table->dropColumn('semester');
        });
    }
}
