<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidation extends FormRequest
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
            'fname'=>'required|string',
            'lname'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|string|unique:users,phone|min:10',
            'role'=>'required|integer',
            'password'=>'required|string|min:6|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'fname.required' => 'Le champ prénom est requis.',
            'lname.required' => 'Le champ nom de famille est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.required' => 'Le champ téléphone est requis.',
            'phone.min' => 'Le numéro de téléphone doit comporter au moins :min chiffres.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'role.required' => 'Le champ rôle est requis.',
            'role.integer' => 'Le rôle doit être un entier.',
            'password.required' => 'Le champ mot de passe est requis.',
            'password.min' => 'Le mot de passe doit comporter au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.'
        ];
    }
}
