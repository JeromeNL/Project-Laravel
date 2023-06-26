<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomLinkRequest extends FormRequest
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


    public function rules(): array
    {
        return [
            'custom_link' => ['required', 'max:50'],
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
