<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('ay');
            $table->integer('sem')->note('1=First Sem, 2=Second Sem, 3=Summer');
            $table->decimal('tuition_fee',9,2);
            $table->decimal('misc_fee',9,2);
            $table->decimal('total',9,2);
            $table->integer('balance_type')->note('1=Refundable, 2=Collectible');
            $table->integer('student_id');
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
        Schema::dropIfExists('assessments');
    }
}
