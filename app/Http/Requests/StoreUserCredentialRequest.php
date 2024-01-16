<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserCredentialRequest extends FormRequest
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
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|min:8',
            'confirm_password' => 'required|string|min:8|same:password'
        ];
    }

    public function messages(): array
    {   
        return [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'confirm_password.same' => 'The confirmation password does not match the password.',
        ];
    }
}
