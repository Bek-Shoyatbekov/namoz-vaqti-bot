<?php

namespace App\Http\Services\TelegramTraits;

use App\Models\City;
use App\Models\TelegramUser;
use App\Http\Services\TelegramHelpers\Keyboards;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

trait TimeTrait {

    public function sendTomorrow()
    {
        $url = $this->baseUrl."/sendMessage";
        $tomorrow = $this->user->city->tomorrow;
        $timeText = $this->getText($tomorrow);
        

        $response = Http::post(
            $url,
            [
                "chat_id" => $this->user->tg_user_id,
                "text" => $timeText,
                "parse_mode" => "markdown",
                "protect_content" => true,
                "disable_web_page_preview" => true,
                "reply_markup" => $this->getMenuKeyboard()
            ]
        );

    }

    public function sendTime()
    {
        $url = $this->baseUrl."/sendMessage";
        $two_days = $this->user->city->two_days;
        $timeText = $this->getText($two_days);

        $response = Http::post(
            $url,
            [
                "chat_id" => $this->user->tg_user_id,
                "text" => $timeText,
                "parse_mode" => "markdown",
                // "protect_content" => true,
                "disable_web_page_preview" => true,
                "reply_markup" => $this->getMenuKeyboard()
            ]
        );

    }

    private function getText($days) {
        $lang = mb_substr($this->user->language, 0, 2);
        $textTime = "📍*".$this->user->city->getTranslation("title", $lang) ."*\n\n";
        $textTime .= $this->generateTimeText($days[0]);
        $asr = Carbon::parse( $days[0]->gregorian_date->format("Y-m-d") . " " . $days[0]->asr);

        if($asr < Carbon::now()) {
            $textTime .= "\n\n";
            $textTime .= $this->generateTimeText($days[1]);
        }
        
        $textTime .= "\n\nhttps://namozvaqti.uz/$lang";

        return $textTime;
    }


    private function generateTimeText($day)
    {
        $times = [$day->tong, $day->quyosh, $day->peshin, $day->asr, $day->shom, $day->hufton];

        $text = [
            "ru" => "🗓*Дата*: ".$day->gregorian_date->format("d-m-Y") . "\n🌙*Дата по хиджре:* " . $day->qamar_date->format("d-m-Y") . "\n\n🌆*Фаджр*: $day->tong\n🌅*Восход*: $day->quyosh\n🏙*Зухр*: $day->peshin\n🌁*Аср*: $day->asr\n🌄*Магриб*: $day->shom\n🌃*Иша*: $day->hufton",
            "oz" => "🗓*Сана*: ".$day->gregorian_date->format("d-m-Y") . "\n🌙*Қамар сана:* " . $day->qamar_date->format("d-m-Y") . "\n\n🌆*Бомдод*: $day->tong\n🌅*Қуёш*: $day->quyosh\n🏙*Пешин*: $day->peshin\n🌁*Аср*: $day->asr\n🌄*Шом*: $day->shom\n🌃*Хуфтон*: $day->hufton",
            "uz" => "🗓*Sana*: ".$day->gregorian_date->format("d-m-Y") . "\n🌙*Qamar sana:* " . $day->qamar_date->format("d-m-Y") . "\n\n🌆*Bomdod*: $day->tong\n🌅*Quyosh*: $day->quyosh\n🏙*Peshin*: $day->peshin\n🌁*Asr*: $day->asr\n🌄*Shom*: $day->shom\n🌃*Xufton*: $day->hufton",
            "en" => "🗓*Date*: ".$day->gregorian_date->format("d-m-Y") . "\n🌙*Hijri date:* " . $day->qamar_date->format("d-m-Y") . "\n\n🌆*Fajr*: $day->tong\n🌅*Shuruk*: $day->quyosh\n🏙*Dhuhr*: $day->peshin\n🌁*Asr*: $day->asr\n🌄*Maghrib*: $day->shom\n🌃*Isha*: $day->hufton"
        ];

        $lang = mb_substr($this->user->language, 0, 2);
        return $text[$lang];
        
    }

    private function getMenuKeyboard() 
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