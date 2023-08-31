<?php

namespace App\Http\Services\TelegramHelpers;

class Keyboards {
    public static function getLanguageKeyboard() {
        return json_encode(
            [
                'inline_keyboard' => 
                [
                    0 => 
                    [
                        0 => 
                        [
                            'text' => '🇺🇿 O\'zbek tili',
                            'callback_data' => '{"action":"setLanguage","value":"uzbek"}',
                        ],
                        1 => 
                        [
                            'text' => '🇺🇿 Ўзбек тили',
                            'callback_data' => '{"action":"setLanguage","value":"ozbek"}',
                        ],
                    ],
                    1 => 
                    [
                        0 => 
                        [
                            'text' => '🇷🇺 Русский',
                            'callback_data' => '{"action":"setLanguage","value":"russian"}',
                        ],
                        1 => 
                        [
                            'text' => '🇬🇧 English',
                            'callback_data' => '{"action":"setLanguage","value":"english"}',
                        ],
                    ],
                ],
            ]);
    }


    public static function generateLocationKeyboard($modelList, $action, $lang){
        $keyboard = [];

        foreach ($modelList as $model) {
            $cData = '{"action": "'. $action .'", "value": "'.$model->id.'" }';

            $keyboard["inline_keyboard"][][] = [
                "text" => $model->getTranslation("title", $lang),
                "callback_data" => $cData
            ];
        }


        $backBtnText = match ($lang) {
            "en" => "◀️ Back",
            "uz" => "◀️ Qaytish",
            "ru" => "◀️ Вернуться",
            "oz" => "◀️ Кайтиш"
        };

        $keyboard["inline_keyboard"][][] = [
            "text" => $backBtnText,
            "callback_data" => '{"action": "'. $action .'", "value": "-1" }'
        ];
        
        return json_encode($keyboard);
    }


}
