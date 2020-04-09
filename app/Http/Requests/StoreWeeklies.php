<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeeklies extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user();
    }

    public function rules(): array
    {
        return [
            'edition' => 'required|integer|unique:weeklies',
            'released_at' => 'required|date',
            'description' => 'required'
        ];
    }
}
