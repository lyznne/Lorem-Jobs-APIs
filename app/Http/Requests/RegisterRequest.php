<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:150'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'max:250'],

        ];
    }

   

     public function messages(): array
     {
        return [
            'name.required' => "username is missing!",
            'name.min' => "username is below the minimum characters!",
            'name.max' => 'username is too long!',

            'email.required' => "email address is missing!",
            'email.email' => "Not a valid email address!", 
            'email:unique' => "email already exists!",

            'password.required' => "password is missing!",
            'password.min' => "password is below minimum characters!",
            "password.max" => "Too long password!",

        ];
        
     }
}
