<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('location'));
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:128'],
            'city' => ['required', 'string', 'max:128'],
            'address' => ['required', 'string', 'max:128'],
            'schedule' => ['required', 'array', 'size:7'],
            'schedule.*' => ['present', 'string', 'max:128'],
            'oldPhotos' => ['nullable', 'array', 'max:12'],
            'oldPhotos.*' => ['filled', 'string'],
            'photos' => ['nullable', 'array', 'max:12'],
            'photos.*' => ['filled', 'mimes:png,jpg', 'max:2048'],
            'video' => ['nullable', 'mimes:mpeg,mp4,avi', 'max:10240'],
        ];
    }
}
