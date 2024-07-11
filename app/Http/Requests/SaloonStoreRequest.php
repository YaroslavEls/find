<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaloonStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $orig = new LocationStoreRequest();

        return [
            'name' => ['required', 'string', 'max:128'],
            'descr' => ['required', 'string', 'max:4096'],
            'logo' => ['required', 'mimes:png,jpg,svg', 'max:2048'],
            'socials' => ['required', 'array', 'max:5'],
            'socials.*' => ['nullable', 'url:https', 'max:128'],
            
            'locations' => ['required', 'array', 'max:50'],
            'locations.*' => ['required', 'array:name,city,address,schedule,photos,video'],

            'locations.*.name' => $orig->rules()['name'],
            'locations.*.city' => $orig->rules()['city'],
            'locations.*.address' => $orig->rules()['address'],
            'locations.*.schedule' => $orig->rules()['schedule'],
            'locations.*.schedule.*' => $orig->rules()['schedule.*'],
            'locations.*.photos' => $orig->rules()['photos'],
            'locations.*.photos.*' => $orig->rules()['photos.*'],
            'locations.*.video' => $orig->rules()['video'],
        ];
    }
}
