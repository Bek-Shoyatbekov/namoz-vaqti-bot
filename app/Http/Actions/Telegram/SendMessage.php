<?php


namespace App\Http\Actions\Telegram;

use App\Http\Actions\Telegram\Traits\RemoteRequest;

class SendMessage {

    use RemoteRequest;

    public function __invoke($data) {

        info("SendMessage: " . print_r($data, true));

        $this->method = "sendMessage";
        $this->data = $data;
        $response = $this->makeRequest();
        return is_null($response) ? ["error" => "null"] : json_decode($response);
    }


}