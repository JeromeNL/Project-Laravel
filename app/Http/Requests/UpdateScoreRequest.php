<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust the authorization logic if needed
    }


    public function rules()
    {
        return [
            'rating' => 'required|between:0.5,5.0',
            'submission_id' => 'required|integer',
            'comment' => 'nullable|max:255'
        ];
    }


    public function messages()
    {
        return [
            'rating.required' => 'Selecteer een geldig aantal sterren!',
            'comment.max' => 'Comment kan niet langer zijn dan :max characters.'
        ];
    }


    public function prepareForValidation()
    {
        $requestArray = $this->all();

        foreach ($requestArray as $key => $value) {
            if (preg_match('/^rating-\d+$/', $key)) {
                $this->merge([
                    'rating' => $value,
                ]);
                $this->offsetUnset($key);
            }
        }
    }
}
