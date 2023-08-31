<?php

namespace App\Http\Services\TelegramTraits;

use Illuminate\Support\Facades\Http;
use App\Http\Services\TelegramHelpers\Keyboards;
use App\Models\TelegramUser;


trait LanguageTrait {
    public function sendLanguageSelection(){

        $url = $this->baseUrl."/sendMessage";

        $response = Http::post(
            $url,
            [
                "chat_id" => $this->user->tg_user_id,
                "text" => $this->getLangText(),
                "reply_markup" => Keyboards::getLanguageKeyboard()
            ]
        );
    }

    public function setLanguage($language){
        
        $this->user->language = $language;
        $this->user->is_subscribed = 1;
        $this->user->save();

        if($this->user->city_id == null) {
            $this->sendRegionsList();
            return;
        }
        else {
            $this->sendTime();
            return;
        }
    }

    private function getLangText(){
        $text[] = "Assalomu aleykum! Tilni tanlang";
        $text[] = "~~~~~~~~~~~~~~~~~~~~~~~~~";
        $text[] = "Здраствуйте! Выберите язык";
        $text[] = "~~~~~~~~~~~~~~~~~~~~~~~~~";
        $text[] = "Hello! Choose language";

        return implode("\n", $text);
    }
}