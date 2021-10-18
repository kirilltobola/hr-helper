<?php

namespace App\Http\Requests;

use App\Rules\Cv\MaxLengthWithoutTags;
use Illuminate\Foundation\Http\FormRequest;

class CvRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:256',
            'email' => [
                'required',
                'email:rfc,dns',
                'max:256',
                'unique:candidates,email,'.$this->route()->originalParameter('cv'),
            ],
            'position' => 'required',
            'programming_level' => 'required',
            'date' => 'required',
            'skills' => [
                'required',
                new MaxLengthWithoutTags(2000),
            ],
            'cv' => [
                'required',
                new MaxLengthWithoutTags(1000),
            ],
            'experience' => [
                'required',
                new MaxLengthWithoutTags(10000),
            ],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Обязательное поле',
            '*.max' => 'Максимальное количество символов :max',
            '*.unique' => 'данный :attribute уже существует',
            '*.email' => 'Должен соответствовать example@example.com',
        ];
    }
}
