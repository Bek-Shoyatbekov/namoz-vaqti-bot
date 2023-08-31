<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintimes', function (Blueprint $table) {
            $table->id();
            $table->date('qamar_date');
            $table->date('greg_date');
            $table->string('tong', 10);
            $table->string('quyosh', 10);
            $table->string('peshin', 10);
            $table->string('asr', 10);
            $table->string('shom', 10);
            $table->string('hufton', 10);
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
        Schema::dropIfExists('maintimes');
    }
}
