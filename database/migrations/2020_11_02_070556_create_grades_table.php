<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $checkTable = Schema::hasTable('grades');

        if(!$checkTable){
            Schema::create('grades', function (Blueprint $table) {
                $table->id();
                $table->integer('subjectId');
                $table->integer('profileId');
                $table->string('grade');
                $table->integer('ay');
                $table->integer('sem');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
