<?php

namespace App\Models;

use App\Models\GeneratedTime;
use App\Models\City;
use App\Http\Traits\TelegramMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;
    use TelegramMethods;

    protected $fillable = ["tg_user_id", "language", "step", "region_id", "city_id", "is_subscribed"];

    public function city()
    {
        return $this->belongsTo(City::class);
    }


}


