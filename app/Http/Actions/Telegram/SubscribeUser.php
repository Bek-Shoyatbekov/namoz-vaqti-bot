<?php

namespace App\Http\Actions\Telegram;

use App\Models\TelegramUser;

class SubscribeUser{

    private $tg_user_id;

    public function __construct(int $tg_user_id)
    {
        $this->tg_user_id = $tg_user_id;
    }

    public function __invoke()
    {
        $tg_user = TelegramUser::firstOrNew(
            ["tg_user_id" => $this->tg_user_id],
            ["is_subscribed" => 1]
        );

        info("SubscribeUser $this->tg_user_id");

        $is_new_user = !isset($tg_user->id);

        info(intval($is_new_user));

        $tg_user->save();

        if($is_new_user || $tg_user->step == 1) (new SendGreetings($this->tg_user_id))();

        return "subsribed $this->tg_user_id";

    }
}
