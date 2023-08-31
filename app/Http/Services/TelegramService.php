<?php 

namespace App\Http\Services;

use App\Models\City;
use App\Models\TelegramUser;
use App\Http\Services\TelegramHelpers\Keyboards;
use App\Http\Services\TelegramTraits\CityTrait;
use App\Http\Services\TelegramTraits\RegionTrait;
use App\Http\Services\TelegramTraits\LanguageTrait;
use App\Http\Services\TelegramTraits\TimeTrait;
use App\Http\Services\TelegramTraits\JumaImageTrait;
use Illuminate\Support\Facades\Http;

class TelegramService {
    use LanguageTrait;
    use RegionTrait;
    use CityTrait;
    use TimeTrait;
    use JumaImageTrait;

    public function __construct($id)
    {
        $this->user = TelegramUser::firstOrNew(["tg_user_id" =>$id]);
        $token = config("app.telegram_token");
        $this->baseUrl = "https://api.telegram.org/bot$token";
    }

    public function startMessage()
    {
        $this->user->is_subscribed = 1;
        $this->user->save();
        if($this->user->language == null) {
            $this->sendLanguageSelection();
            return;
        }
        else if ($this->user->city_id == null) {
            $this->sendRegionsList();
            return;
        } else {
            $this->sendTime();
            return;
        }

    }

    public function unsubscribe()
    {
        $this->user->is_subscribed = 0;
        $this->user->save();
    }


    public function deleteMessage($message_id)
    {
        $url = $this->baseUrl . "/deleteMessage";

        $response = Http::post(
            $url,
            [
                "chat_id" => $this->user->tg_user_id,
                "message_id" => $message_id
            ]
        );

    }

}