<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaloonUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:128'],
            'descr' => ['required', 'string', 'max:4096'],
            'logo' => ['nullable', 'mimes:png,jpg,svg', 'max:2048'],
            'socials' => ['required', 'array', 'max:5'],
            'socials.*' => ['nullable', 'url:http,https', 'max:128'],
        ];
    }
}
