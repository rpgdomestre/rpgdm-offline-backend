<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveLinks extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:links,id',
            'edition' => 'required|exists:links,edition',
        ];
    }
}
