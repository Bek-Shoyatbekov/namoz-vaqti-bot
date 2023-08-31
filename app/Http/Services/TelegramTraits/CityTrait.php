<?php

namespace App\Http\Services\TelegramTraits;


use App\Models\City;
use App\Models\TelegramUser;
use App\Http\Services\TelegramHelpers\Keyboards;
use Illuminate\Support\Facades\Http;

trait CityTrait {
    public function sendCityList(){

        $lang = mb_substr($this->user->language, 0, 2);
        $url = $this->baseUrl . "/sendMessage";

        $response = Http::post(
            $url,
            [
                "chat_id" => $this->user->tg_user_id,
                "text" => $this->getCityText($lang),
                "reply_markup" => Keyboards::generateLocationKeyboard(
                    City::where("region_id", $this->user->region_id)->lazy(), "setCity", $lang
                )
            ]
        );

    }

    public function setCity($cityId){
        if($cityId == -1) {
            $this->sendRegionsList();
            return;
        }
        $this->user->is_subscribed = 1;
        $this->user->city_id = $cityId;
        $this->user->save();

        $this->sendTime();

    }

    private function getCityText ($lang) {
        $data = [
            "ru" => "Выберите город",
            "en" => "Select city",
            "oz" => "Шахарни танланг",
            "uz" => "Shaharni tanlang",
        ];
        return $data[$lang];
    }
}