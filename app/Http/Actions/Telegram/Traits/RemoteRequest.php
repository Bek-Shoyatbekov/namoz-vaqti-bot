<?php

namespace App\Http\Actions\Telegram\Traits;

trait RemoteRequest{

    private $data;
    private $method;

    private function makeRequest() {
        $ch = curl_init(env("TELEGRAM_URL") . $this->method);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-type:application/json"]);
        if($this->data !== []){
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));
        }
        $result = curl_exec($ch);
        if($result) {
            curl_close($ch);
            return $result;
        } else {
            info(curl_error($ch));
            curl_close($ch);
            return null;
        }
    }

    private function clearData(){
        $this->data = [];
    }


}