<?php

namespace App\Http\Services\TelegramTraits;

use App\Models\Region;
use App\Models\TelegramUser;
use App\Http\Services\TelegramHelpers\Keyboards;
use Illuminate\Support\Facades\Http;


trait RegionTrait {

    public function sendRegionsList(){
        $lang = mb_substr($this->user->language, 0, 2);
        $url = $this->baseUrl . "/sendMessage";

        $response = Http::post(
            $url, 
            [
                "chat_id" => $this->user->tg_user_id,
                "text" => $this->getRegionsText($lang),
                "reply_markup" => Keyboards::generateLocationKeyboard(
                    Region::lazy(), "setRegion", $lang
                )
            ]
        );
    }

    public function setRegion($regionId){
        if($regionId == -1) {
            $this->sendLanguageSelection();
            return;
        }

        $this->user->region_id = $regionId;
        $this->user->save();

        $this->sendCityList();
    }

    private function getRegionsText ($lang) {
        $data = [
            "ru" => "Выберите область",
            "en" => "Select region",
            "oz" => "Вилоятни танланг",
            "uz" => "Viloyatni tanlang",
        ];
        return $data[$lang];
    }


}
