<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostScoreRequest extends FormRequest
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
            'rating' => 'required',
            'submission_id' => 'required',
            'competition_id' => 'required',
            'comment' => 'nullable'
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
