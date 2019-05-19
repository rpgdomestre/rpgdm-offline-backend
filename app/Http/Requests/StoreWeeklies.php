<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeeklies extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return (bool) $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'edition' => 'required|integer|unique:weeklies',
            'released_at' => 'required|date',
            'from' => 'required|date',
            'to' => 'required|date|different:from',
            'description' => 'required'
        ];
    }
}
