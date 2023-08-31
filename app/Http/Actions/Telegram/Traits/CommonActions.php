<?php 

namespace App\Http\Actions\Telegram\Traits;

trait CommonActions {

    private function setCallbackData($action, $value) {
        return json_encode([
            "action" => $action,
            "value" => $value
        ]);
    }


}