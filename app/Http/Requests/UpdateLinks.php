<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLinks extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (bool) $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'link' => 'required|url|exists:links,link',
            'name' => 'required',
            'type' => [
                'required',
                Rule::in(['Nacional', 'Internacional', 'Geral'])
            ],
            'section_id' => 'required|exists:sections,id',
            'source' => 'required',
            'via' => 'nullable',
            'edition' => 'required|exists:weeklies,id'
        ];
    }
}
