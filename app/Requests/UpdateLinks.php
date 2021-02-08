<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLinks extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'link' => 'required|url|exists:links,link',
            'name' => 'required',
            'type' => [
                'required',
                Rule::in(['nacional', 'internacional', 'geral']),
            ],
            'section_id' => 'required|exists:sections,id',
            'sourceName' => 'required',
            'via' => 'nullable',
            'edition' => 'required|exists:weeklies,id'
        ];
    }
}
