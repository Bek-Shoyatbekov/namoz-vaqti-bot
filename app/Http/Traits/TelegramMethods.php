<?php

namespace App\Http\Traits;

use App\Models\City;
use App\Models\Region;
use App\Models\TelegramUser;
use App\Http\Traits\RemoteRequest;

trait TelegramMethods{

    // use RemoteRequest;

    private function sendMessage() {
        $this->method = "sendMessage";
        $response = $this->makeRequest();
        return is_null($response) ? ["error" => "null"] : json_decode($response);
    }

    private function setCallbackData($action, $value) {
        return json_encode([
            "action" => $action,
            "value" => $value
        ]);
    }

    private function sendRegionListWithTgUser(TelegramUser $user)
    {
        $this->clearData();
        $this->method = "sendMessage";
        $text = [];
        $lang = "uz";

        switch($user->language) {
            case "russian": $text[] = "Выберите область"; $lang = "ru"; break;
            case "english": $text[] = "Choose the Region"; $lang = "en"; break;
            case "ozbek": $text[] = "Вилоятни танланг"; $lang = "oz"; break;
            default: $text[] = "Viloyatni tanlang";
        }

        $regions = Region::all();
        $regionsButtonList = $regions->map(function(Region $region) use($lang) {
            return [$this->createButton(
                title: $region->getTranslation("title", $lang),
                func_name: "setRegion",
                value: $region->id 
            )];
        });

        $this->data = [
            "chat_id" => intval($user->tg_user_id),
            "text" => implode("\n", $text),
            "reply_markup" => [
                "inline_keyboard" => 
                    $regionsButtonList
                
            ]
        ];

        return $this->makeRequest(); 
    }

    private function sendCityListWithTgUser(TelegramUser $user, Region $region)
    {
        $this->clearData();
        $this->method = "sendMessage";
        $text = [];
        $lang = "uz";

        switch($user->language) {
            case "russian": $text[] = "Выберите город"; $lang = "ru"; break;
            case "english": $text[] = "Choose the City"; $lang = "en"; break;
            case "ozbek": $text[] = "Шахарни танланг"; $lang = "oz"; break;
            default: $text[] = "Shaharni tanlang";
        }

        $cities = $region->cities;
        $cityButtonsList = $cities->map(function(City $city) use($lang) {
            return [$this->createButton(
                title: $city->getTranslation("title", $lang),
                func_name: "setCity",

                value: $city->id 
            )];
        });

        $this->data = [
            "chat_id" => intval($user->tg_user_id),
            "text" => implode("\n", $text),
            "reply_markup" => [
                "inline_keyboard" => 
                    $cityButtonsList
                
            ]
        ];

        return $this->makeRequest();
    }

    private function sendGreetingWithId(int $user_id)
    {
        $text = [""];
		$text[] = "Assalomu aleykum! Tilni tanlang";
		$text[] = "~~~~~~~~~~~~~~~~~~~~~~~~~";
		$text[] = "Здраствуйте! Выберите язык";
		$text[] = "~~~~~~~~~~~~~~~~~~~~~~~~~";
		$text[] = "Hello! Choose language";

		$this->data = [
			"chat_id" => $user_id,
			"text" => implode("\n", $text),
			"reply_markup" => [
				"inline_keyboard" => [
					[
						[
                            "text" => "🇺🇿 O'zbek tili",
                            "callback_data" => $this->setCallbackData("setLanguage", "uzbek")
                        ],
						[
                            "text" => "🇺🇿 Ўзбек тили ",
                            "callback_data" => $this->setCallbackData("setLanguage", "ozbek")
                        ]
					], 
					[
						[
                            "text" => "🇷🇺 Русский",
                            "callback_data" => $this->setCallbackData("setLanguage", "russian")
                        ],
						[
                            "text" => "🇬🇧 English",
                            "callback_data" => $this->setCallbackData("setLanguage", "english")
                        ]
					],
				]
            ]
        ];

        return $this->sendMessage();
    }

    private function createButton($title, $func_name, $value)
    {
        return [
            "text" => $title,
            "callback_data" => $this->setCallbackData($func_name, $value)
        ];
    }

    private function deleteMessage($chat_id, $message_id)
    {
        $this->clearData();
        $this->method = "deleteMessage";
        $this->data = [
            "chat_id" => $chat_id,
            "message_id" => $message_id
        ];
        return json_decode($this->makeRequest());

    }


}