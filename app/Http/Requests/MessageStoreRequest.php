<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('message', $this->route('chat'));
    }

    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:4096']
        ];
    }
}
