<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeeklies extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user();
    }

    public function rules(): array
    {
        return [
            'edition' => 'required|integer|exists:weeklies',
            'released_at' => 'required|date',
            'description' => 'required'
        ];
    }
}
