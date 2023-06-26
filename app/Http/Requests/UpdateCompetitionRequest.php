<?php

namespace App\Http\Requests;

use App\Models\Competition;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompetitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $competition = Competition::find($this->route('competition'));
        return $this->user()->id === $competition->owner_id;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'submissions_limit' => 'required|integer|max:5',
            'thumbnail_url' => 'nullable|url',
            'publication_status' => 'nullable',
            'custom_link' => 'nullable|string',
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
            'submissions_limit.max' => 'Het aantal inzendingen mag niet hoger zijn dan 5.',
            'thumbnail_url.url' => 'De thumbnail moet een geldige url zijn.',
            'publication_status.required' => 'De publicatie status is verplicht.',
            'custom_link.string' => 'De alias van de deelbare link moet een geldig woord zijn.',
        ];
    }
}
