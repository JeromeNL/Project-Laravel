<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class EditCompetitionAPIRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'competition_id' => 'required',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'submissions_limit' => 'required',
            'thumbnail_url' => 'nullable|url',
            'custom_link' => 'nullable|string',
            'private' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Een titel is verplicht.',
            'start_date.date' => 'De startdatum moet een geldige datum zijn.',
            'start_date.required' => 'De startdatum is verplicht.',
            'end_date.after_or_equal' => 'De einddatum moet na de startdatum zijn of leeg gelaten worden.',
            'submissions_limit.required' => 'Het aantal inzendingen is verplicht.',
            'thumbnail_url.url' => 'De thumbnail moet een geldige url zijn.',
            'publication_status.required' => 'De publicatie status is verplicht.',
            'custom_link.string' => 'De alias van de deelbare link moet een geldig woord zijn.',
        ];
    }
}
