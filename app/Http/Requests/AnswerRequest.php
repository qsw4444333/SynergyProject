<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
            'form_id' => 'integer',
            'form_name' => 'string',
            'user_email' => 'string',
            'answer1' => 'string',
            'answer2' => 'string',
            'answer3' => 'string',
            'answer4' => 'string',
            'answer5' => 'string',
            'answer6' => 'string'
        ];
    }
}
