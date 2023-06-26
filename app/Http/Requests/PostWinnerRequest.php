<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostWinnerRequest extends FormRequest
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
            'winner_name' => 'required|string|max:50',
            'message' => 'required|string|max:50',
        ];
    }


    public function messages(): array
    {
        return [
            'winner_name.max' => 'De naam mag niet langer zijn dan :max karakters',
            'winner_name.required' => 'De naam is verplicht om in te vullen',
            'message.max' => 'Een quote mag niet langer zijn dan :max karakters',
            'message.required' => 'Het bericht veld is verplicht om  in te vullen',
        ];
    }
}
