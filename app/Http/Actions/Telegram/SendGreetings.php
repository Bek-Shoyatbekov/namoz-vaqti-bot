<?php 

namespace App\Http\Actions\Telegram;

use App\Http\Actions\Telegram\SendMessage;
use App\Http\Actions\Telegram\Traits\CommonActions;

class SendGreetings {

    use CommonActions;

    private $tg_user_id;

    public function __construct(int $tg_user_id)
    {
        $this->user_id = $tg_user_id;
    }

    public function __invoke()
    {
        $text = [""];
		$text[] = "Assalomu aleykum! Tilni tanlang";
		$text[] = "~~~~~~~~~~~~~~~~~~~~~~~~~";
		$text[] = "Здраствуйте! Выберите язык";
		$text[] = "~~~~~~~~~~~~~~~~~~~~~~~~~";
		$text[] = "Hello! Choose language";

        info("SendGreeting $this->user_id");


		$data = [
			"chat_id" => $this->user_id,
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

        return (new SendMessage())($data);
    }

}