<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginValidation extends FormRequest
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
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:6'
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.exists' => "L'email n'existe pas ",
            'password.required' => 'Le champ mot de passe est requis.',
            'password.min' => 'Le mot de passe doit comporter au moins :min caractères.'
        ];
    }
}
