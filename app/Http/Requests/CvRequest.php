<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CvRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:256',
            'email' => 'required|email:rfc,dns|max:256',
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
            'name.required' => 'Обязательное поле.',
            'name.max' => 'Должно быть меньше :max символов.',
            'email.email' => 'Должно соответствовать text@text.text'
        ];
    }
}
