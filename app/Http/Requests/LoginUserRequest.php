<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginUserRequest extends FormRequest
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
            'email' => ['required', 'email', "exists:users"],
            'password' => ['required', 'min:8'],
        ];
    }
//    protected function failedValidation(Validator $validator) // Validator of Contracts
//    {
//
//        if ($this->is('api/*')) {
//            $response = $this->sendResponse($validator->errors(), 'validation failed', 422 );
//            throw new ValidationException($validator, $response);
//        }
//    }
}
