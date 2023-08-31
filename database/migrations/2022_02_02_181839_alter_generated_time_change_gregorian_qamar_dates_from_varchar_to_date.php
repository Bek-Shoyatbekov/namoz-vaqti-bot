<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGeneratedTimeChangeGregorianQamarDatesFromVarcharToDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generated_time', function (Blueprint $table) {
            $table->date("gregorian_date")->change();
            $table->date("qamar_date")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generated_time', function (Blueprint $table) {
            $table->string("gregorian_date")->change();
            $table->string("qamar_date")->change();

        });
    }
}
