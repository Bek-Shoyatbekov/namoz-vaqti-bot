<?php

use App\Models\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneratedTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generated_time', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(City::class)->constrained();
            $table->string('gregorian_date');
            $table->string('qamar_date');
            $table->string('tong');
            $table->string('quyosh');
            $table->string('peshin');
            $table->string('asr');
            $table->string('shom');
            $table->string('hufton');
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
        Schema::dropIfExists('generated_time');
    }
}
