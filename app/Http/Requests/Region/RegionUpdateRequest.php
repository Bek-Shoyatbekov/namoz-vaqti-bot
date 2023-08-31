<?php

namespace App\Http\Requests\Region;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegionUpdateRequest extends FormRequest
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
            'slug' => [
                'required',
                Rule::unique('regions')->ignore($this->region_id)
            ],
            'title_uz' => "required",
            'title_oz' => "required",
            'title_en' => "required",
            'title_ru' => "required",
        ];
    }
}
