<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeekerStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $jobs = ['Бариста', 'Старший Бариста'];
        $employments = ['Повна', 'Не повна', 'Виходжу на підміни'];

        return [
            'name' => ['required', 'string', 'max:128'],
            'birthday' => ['required', 'date', 'before:-16 years'],
            'photo' => ['required', 'mimes:png,jpg', 'max:2048'],
            'job' => ['required', 'string', Rule::in($jobs)],
            'experience' => ['required', 'numeric', 'min:0', 'max:6.5'],
            'salary' => ['required', 'numeric', 'min:0', 'max:999999'],
            'city' => ['required', 'string', 'max:128'],
            'employment' => ['required', 'array', 'max:3'],
            'employment.*' => ['filled', 'string', Rule::in($employments)],
            'info' => ['required', 'string', 'max:4096'],
            'cv' => ['nullable', 'mimes:pdf', 'max:2048']
        ];
    }

    public function messages(): array
    {
        return [
            'birthday.before' => 'Реєстрація для користувачів старше 16 років',
        ];
    }
}
