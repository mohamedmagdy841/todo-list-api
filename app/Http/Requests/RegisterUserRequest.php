<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function Laravel\Prompts\password;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
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
