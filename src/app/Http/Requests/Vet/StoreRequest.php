<?php

namespace App\Http\Requests\Vet;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'card_id' => 'required|string|unique:vets',
            'experience' => 'required|string',
            'reference' => 'required|string',
            'location' => 'required|string'
        ];
    }
}
