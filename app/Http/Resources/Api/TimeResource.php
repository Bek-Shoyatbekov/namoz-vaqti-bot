<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "city_id" => (int) $this->city_id,
            "date" => $this->gregorian_date->format("Y-m-d"),
            "qamar_date" => $this->qamar_date->format("Y-m-d"),
            "tong" => $this->tong,
            "quyosh" => $this->quyosh,
            "peshin" => $this->peshin,
            "asr" => $this->asr,
            "shom" => $this->shom,
            "hufton" => $this->hufton
        ];
    }
}
