<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminCatalogRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:256',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Обязательное поле',
            '*.max' => 'Максимальное количество символов :max',
        ];
    }
}
