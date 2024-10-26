<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreTodoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'string'],
            'priority' => ['nullable', 'string'],
        ];
    }
//    protected function failedValidation(Validator $validator) // Validator of Contracts
//    {
//
//        if ($this->is('api/*')) {
//            $response = $this->sendResponse($validator->errors(), 'Validation failed', 422 );
//            throw new ValidationException($validator, $response);
//        }
//    }
}
