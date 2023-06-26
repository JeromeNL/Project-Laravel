<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StoreCompetitionRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'submissions_limit' => 'required|integer|max:5',
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
            'submissions_limit.max' => 'Het aantal inzendingen mag niet hoger zijn dan 5.',
            'thumbnail_url.url' => 'De thumbnail moet een geldige url zijn, als je deze invult.',
            'publication_status.required' => 'De publicatie status is verplicht.',
            'owner_id.required' => 'Een owner_id opgeven is verplicht.'
        ];
    }
}
