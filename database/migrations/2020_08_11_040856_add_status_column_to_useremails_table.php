<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToUseremailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('useremails', function (Blueprint $table) {
            $table->integer('status')->default('0')->after('lms_password')->comments('0 = Not Activated, 1 = Activated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('useremails', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
