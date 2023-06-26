<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class APICustomLinkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

    public function authorize(): bool
    {
        return true;
    }


    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }


    public function rules(): array
    {
        return [
            'custom_link' => ['required', 'max:50'],
            'competition_id' => [
                Rule::requiredIf($this->is('api/*')), // Verplicht alleen voor API-verzoeken
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'custom_link.required' => "Een link is verplicht",
            'custom_link.max:50' => "Het custom gedeelte van een link mag maximaal 50 tekens bevatten",
            'competition_id.required' => "Een competition_id is verplicht!"
        ];
    }
}
