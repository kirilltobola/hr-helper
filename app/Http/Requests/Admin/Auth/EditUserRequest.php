<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;


class EditUserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:256',
            'email' => [
                'required',
                'email:rfc,dns',
                'max:256',
                'unique:users,email,'.$this->route()->originalParameter('user'),
            ],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Обязательное поле',
            '*.max' => 'Максимальное количество символов :max',
            '*.min' => 'Минимальное количество символов :min',
            '*.unique' => 'Данный :attribute уже существует',
            '*.email' => 'Должен соответствовать example@example.com',
        ];
    }
}
