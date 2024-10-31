<?php

namespace App\Http\Requests;

use App\Rules\LocationUnique;
use App\Rules\PhotosRequired;
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
            'name' => ['required', 'string', 'max:128', new LocationUnique],
            'city' => ['required', 'string', 'max:128'],
            'address' => ['required', 'string', 'max:128'],
            'schedule' => ['required', 'array', 'size:7'],
            'schedule.*' => ['present', 'nullable', 'string', 'max:128'],
            'gen' => ['required', 'boolean'],
            'oldPhotos' => ['nullable', 'array', 'max:12'],
            'oldPhotos.*' => ['filled', 'string'],
            'photos' => ['nullable', 'array', 'max:12', new PhotosRequired],
            'photos.*' => ['filled', 'mimes:png,jpg', 'max:10240'],
            'video' => ['nullable', 'mimes:mpeg,mp4,avi,m4v', 'max:102400'],
            'videoDeleted' => ['required', 'boolean']
        ];
    }
}
