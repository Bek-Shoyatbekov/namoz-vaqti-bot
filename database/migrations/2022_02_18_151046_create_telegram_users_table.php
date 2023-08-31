<?php

use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelegramUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id();
            $table->double("tg_user_id");
            $table->tinyInteger("step")->default(1);
            $table->foreignIdFor(Region::class)->nullable();
            $table->foreignIdFor(City::class)->nullable();
            $table->enum("language", ["uzbek", "ozbek", "russian", "english"])->nullable();
            $table->boolean("is_subscribed")->default(1);
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
        Schema::dropIfExists('telegram_users');
    }
}
