<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CvRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:256',
            'email' => 'required|unique:candidates|email:rfc,dns|max:256',
            'position' => 'required',
            'programming_level' => 'required',
            'date' => 'required',
            'skills' => 'required',
            'cv' => 'required',
            'experience' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Обязательное поле',
            '*.max' => 'Максимальное количество символов :max',
            '*.unique' => 'данный :attribute уже существует',
            '*.email' => 'Должен соответствовать text@text.text',
        ];
    }
}
