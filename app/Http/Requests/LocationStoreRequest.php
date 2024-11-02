<?php

namespace App\Http\Requests;

use App\Models\Location;
use App\Rules\LocationUnique;
use Illuminate\Foundation\Http\FormRequest;

class LocationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Location::class);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:128', new LocationUnique],
            'city' => ['required', 'string', 'max:128'],
            'address' => ['required', 'string', 'max:128'],
            'schedule' => ['required', 'array', 'size:7'],
            'schedule.*' => ['present', 'nullable', 'string', 'max:128'],
            'gen' => ['required', 'boolean'],
            'photos' => ['required', 'array', 'max:12'],
            'photos.*' => ['filled', 'mimes:png,jpg', 'max:10240'],
            'video' => ['nullable', 'mimes:mpeg,mp4,avi,m4v,mov', 'max:102400'],
        ];
    }
}
