<?php

namespace App\Http\Requests\Maintime;

use Illuminate\Foundation\Http\FormRequest;

class MaintimeUpdateOneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "qamar_date" => "required",
            "tong" => "required",
            "quyosh" => "required",
            "peshin" => "required",
            "asr" => "required",
            "shom" => "required",
            "hufton" => "required"
        ];
    }
}
