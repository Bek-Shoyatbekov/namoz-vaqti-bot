<?php

namespace App\Http\Controllers\Admin;


use App\Models\TelegramUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\TelegramService;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\DB;


class TelegramController extends Controller
{

    public function start(Request $request) {
        $user_id = $request->user_id;
        $service = new TelegramService($user_id);
        $service->startMessage();
    }

    public function language(Request $request)
    {
        $user_id = $request->user_id;
        $service = new TelegramService($user_id);
        $service->sendLanguageSelection();
    }

    public function regions(Request $request)
    {
        $user_id = $request->user_id;
        $service = new TelegramService($user_id);
        $service->sendRegionsList();
    }

    public function time(Request $request)
    {
        $user_id = $request->user_id;
        $service = new TelegramService($user_id);
        $service->sendTime();
    }

    public function unsubscribe(Request $request)
    {
        $user_id = $request->user_id;
        $service = new TelegramService($user_id);
        $service->unsubscribe();
    }

    public function setLanguage(Request $request)
    {
        $user_id = $request->user_id;
        $lang = $request->value;
        $messageId = $request->message_id;

        $service = new TelegramService($user_id);
        $service->setLanguage($lang);
        
        $service->deleteMessage($messageId);
    }

    public function setRegion(Request $request)
    {
        $user_id = $request->user_id;
        $regionId = $request->value;
        $messageId = $request->message_id;
        $service = new TelegramService($user_id);
        $service->setRegion($regionId);
        $service->deleteMessage($messageId);

    }    

    public function setCity(Request $request)
    {
        $user_id = $request->user_id;
        $cityId = $request->value;
        $messageId = $request->message_id;
        $service = new TelegramService($user_id);
        $service->setCity($cityId);
        $service->deleteMessage($messageId);

    }

    public function stats(Request $request)
    {
        $totalCount = TelegramUser::where("is_subscribed", 1)->count();
        $countbyCities = DB::select("SELECT c.title as city, count(*) as count FROM telegram_users t, cities c WHERE t.city_id = c.id AND t.is_subscribed = 1 GROUP BY 1");
        
        $cities = [];

        foreach ($countbyCities as $record) {
            $city = json_decode($record->city, true)["uz"];
            $cities[] = [
                "city" => $city,
                "count" => (int)$record->count
            ];
        }

        return [
            "data" => [
                "count" => $totalCount,
                "byCities" => $cities
            ]
            
        ];
    }

    
}