<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class APIStoreCompetitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'submissions_limit' => 'required',
            'thumbnail_url' => 'nullable|url',
            'publication_status' => 'required',
            'private' => 'required',
            'owner_id' => [
                Rule::requiredIf($this->is('api/*')), // Verplicht alleen voor API-verzoeken
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'Een titel is verplicht.',
            'start_date.date' => 'De startdatum moet een geldige datum zijn.',
            'start_date.required' => 'De startdatum is verplicht.',
            'start_date.after_or_equal' => 'De startdatum moet vandaag of na vandaag zijn.',
            'end_date.after_or_equal' => 'De einddatum moet na de startdatum zijn of leeg gelaten worden.',
            'submissions_limit.required' => 'Het aantal inzendingen is verplicht.',
            'thumbnail_url.url' => 'De thumbnail moet een geldige url zijn, als je deze invult.',
            'publication_status.required' => 'De publicatie status is verplicht.',
            'owner_id.required' => 'Een owner_id opgeven is verplicht.'
        ];
    }
}
