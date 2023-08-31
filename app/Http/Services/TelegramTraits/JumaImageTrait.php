<?php

namespace App\Http\Services\TelegramTraits;

use App\Models\JumaImage;
use App\Models\TelegramUser;
use App\Http\Services\TelegramHelpers\Keyboards;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

trait JumaImageTrait {

    public function sendJumaImage()
    {
        $url = $this->baseUrl."/sendPhoto";
        $caption = $this->getJumaText();

        $image = JumaImage::query()->inRandomOrder()->first();
        
        $response = Http::post(
            $url,
            [
                "chat_id" => $this->user->tg_user_id,
                "caption" => $caption,
                "photo" => $image->path,
                "protect_content" => true,
                "disable_web_page_preview" => true,
                "reply_markup" => $this->getMenuKeyboardJuma()
            ]
        );

    }


    private function getJumaText() {
        $lang = mb_substr($this->user->language, 0, 2);
        $textTime = "";

        $textTime .=  match($lang) {
            "uz" => "Juma muborak",
            "en" => "Jummah mubarak",
            "oz" => "Жума муборак",
            "ru" => "Джума мубарак"
        };
        
        $textTime .= "\n\nhttps://namozvaqti.uz/$lang";

        return $textTime;
    }



    private function getMenuKeyboardJuma() 
    {
        $lang = mb_substr($this->user->language, 0, 2);

        $getTimeTxt = match ($lang) {
            "uz" => "Namoz vaqtlarni bilib olish",
            "en" => "Get prey times",
            "oz" => "Намоз вақтларни билиб олиш",
            "ru" => "Узнать время намаза"
        };

        $regionTxt = match($lang) {
            "uz" => "Shaharni o'zgartirish",
            "en" => "Change location",
            "oz" => "Шахарни ўзгартириш",
            "ru" => "Изменить город" 
        };

        $changeLangBtn = match ($lang) {
            "uz" => "Tilni o'zgartirish",
            "en" => "Change language",
            "oz" => "Тилни ўзгартириш",
            "ru" => "Изменить язык"
        };

        $getTimeBtn = ["text" => "🕔 $getTimeTxt"];
        $changeLocationBtn = ["text" => "🌎 $regionTxt"];
        $changeLangBtn = ["text" => "🔤 $changeLangBtn"];

        return json_encode(
            [
                "keyboard" => [

                    [
                        $getTimeBtn
                    ],
                    [
                        $changeLocationBtn
                    ],
                    [
                        $changeLangBtn
                    ]
                ],
                "resize_keyboard" => true,
                "one_time_keyboard " => true,
            ]
        );
    }
}