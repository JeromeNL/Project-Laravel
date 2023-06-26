<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class APIStoreSubmissionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'submission_url' => [
                Rule::requiredIf($this->is('api/*')),
                'nullable', 'required_if:submission_image,null', 'url'
            ],
            'submission_image' => [
                'nullable', 'required_if:submission_url,null', 'mimes:pdf,png,svg,gif,jpg', 'max:50000'],
            'user_id' => [
                Rule::requiredIf($this->is('api/*')), // Verplicht alleen voor API-verzoeken
            ],
            'competition_id' => [
                Rule::requiredIf($this->is('api/*')), // Verplicht alleen voor API-verzoeken
            ],
        ];
    }


    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }


    public function messages(): array
    {
        return [
            'submission_url.url' => 'Jouw foto moet een url zijn.',
            'title.required' => 'Een titel is verplicht.',
            'description.required' => 'Een beschrijving is verplicht',
            'submission_url.required_if' => 'Een afbeelding (url) is verplicht als er geen afbeelding (bestand) is ingevoerd.',
            'submission_image.required_if' => 'Een afbeelding (bestand) is verplicht als er geen afbeelding (url) is ingevoerd.',
            'submission_image.required' => 'Het bestand is verplicht.',
            'submission_image.file' => 'Ongeldig bestandstype.',
            'submission_image.max' => 'Het bestand mag maximaal 50 MB zijn.',
            'user_id.required' => 'Het user_id is verplicht voor een API-call.',
            'competition_id.required' => 'Het competition_id is verplicht voor een API-call.'
        ];
    }
}


