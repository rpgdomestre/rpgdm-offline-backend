<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLinks extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'link' => 'required|url|unique:links',
            'name' => 'required',
            'type' => [
                'required',
                Rule::in(['nacional', 'internacional', 'geral']),
            ],
            'section_id' => 'required|exists:sections,id',
            'sourceName' => 'required',
            'via' => 'required_if:section_id,5',
            'edition' => 'required|exists:weeklies,id',
        ];
    }
}
