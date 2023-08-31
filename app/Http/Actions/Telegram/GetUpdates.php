<?php

namespace App\Http\Actions\Telegram;

use App\Http\Actions\Telegram\Traits\RemoteRequest;


class GetUpdates{

    use RemoteRequest;

    public function __invoke() {
        $this->method = "getUpdates";
        $response = $this->makeRequest();
        return is_null($response) ? ["error" => "null"] : json_decode($response);
    }

}