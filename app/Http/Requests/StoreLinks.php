<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLinks extends FormRequest
{
    public function authorize(): bool
    {
        return (bool)$this->user();
    }

    public function rules(): array
    {
        return [
            'link' => 'required|url|unique:links',
            'name' => 'required',
            'type' => [
                'required',
                Rule::in(['Nacional', 'Internacional', 'Geral']),
            ],
            'section_id' => 'required|exists:sections,id',
            'source' => 'required',
            'via' => 'required_if:section_id,5',
            'edition' => 'required|exists:weeklies,id',
        ];
    }
}
