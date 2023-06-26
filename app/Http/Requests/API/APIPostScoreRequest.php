<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class APIPostScoreRequest extends FormRequest
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
            'rating' => 'required',
            'submission_id' => 'required',
            'competition_id' => 'required',
            'comment' => 'nullable',
            'user_id' => [
                Rule::requiredIf($this->is('api/*')), // Verplicht alleen voor API-verzoeken
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'rating.required' => 'Selecteer een geldig aantal sterren!',
            'submission_id.required' => 'Submission_id is verplicht!',
            'competition_id.required' => 'Competition_id is verplicht!',
            'comment.max' => 'Comment kan niet langer zijn dan :max characters.'
        ];
    }
}
