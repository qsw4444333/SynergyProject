<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormIndRequest extends FormRequest
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
            'name' => 'string',
            'is_visible' => '',
            'question1' => 'string',
            'question2' => 'string',
            'question3' => 'string',
            'question4' => 'string',
            'question5' => 'string',
            'question6' => 'string',
            'author' => 'string'
        ];
    }
}
