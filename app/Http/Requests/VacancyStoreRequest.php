<?php

namespace App\Http\Requests;

use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VacancyStoreRequest extends FormRequest
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
            'location_id' => ['required', 'integer', Rule::exists(Location::class, 'id')],
            'job' => ['required', 'string', Rule::in($jobs)],
            'employment' => ['required', 'array', 'max:3'],
            'employment.*' => ['required', 'string', Rule::in($employments)],
            'experience' => ['required', 'numeric', 'min:0', 'max:6.5'],
            'salary' => ['required', 'numeric', 'min:0', 'max:999999'],
            'descr' => ['required', 'string', 'max:4096']
        ];
    }
}
