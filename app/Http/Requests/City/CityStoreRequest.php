<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class CityStoreRequest extends FormRequest
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
            'slug' => ['required', 'unique:cities,slug'],
            'region_id' => ['required', 'numeric', 'exists:regions,id'],
            'title_uz' => "required",
            'title_oz' => "required",
            'title_en' => "required",
            'title_ru' => "required",
        ];
    }
}
