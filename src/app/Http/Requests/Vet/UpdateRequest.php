<?php

namespace App\Http\Requests\Vet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'card_id' => 'sometimes|required|string|unique:vets,card_id,' . $this->user()->id . ',user_id',
            'experience' => 'sometimes|required|string',
            'reference' => 'sometimes|required|string',
            'location' => 'sometimes|required|string'
        ];
    }
}
