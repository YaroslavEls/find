<?php

namespace App\Http\Requests;

use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VacancyUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('vacancy'));
    }

    public function rules(): array
    {
        $jobs = ['Бариста', 'Старший Бариста'];
        $employments = ['Повна', 'Неповна', 'Підміни'];

        return [
            'location_id' => ['required', 'ulid', Rule::exists(Location::class, 'id')],
            'job' => ['required', 'string', Rule::in($jobs)],
            'employment' => ['required', 'array', 'max:3'],
            'employment.*' => ['required', 'string', Rule::in($employments)],
            'experience' => ['required', 'numeric', 'min:0', 'max:6.5'],
            'salary' => ['required', 'numeric', 'min:0', 'max:999999'],
            'descr' => ['required', 'string', 'max:4096']
        ];
    }
}
