<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkAsWinnerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'submission_id' => 'required|integer',
            'competition_id' => 'required|integer',
        ];
    }


    public function messages(): array
    {
        return [
            'submission_id.required' => 'Een submission_id is verplicht!',
            'competition_id.required' => 'Een competition_id is verplicht!'
        ];
    }
}
