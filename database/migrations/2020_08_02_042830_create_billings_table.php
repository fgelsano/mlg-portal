<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $checkTable = Schema::hasTable('billings');

        if(!$checkTable){
            Schema::create('billings', function (Blueprint $table) {
                $table->id();
                $table->integer('enrollment_id');
                $table->string('fee');
                $table->decimal('amount',9,2);
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
        Schema::dropIfExists('billings');
    }
}
