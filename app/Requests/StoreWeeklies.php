<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeeklies extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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
