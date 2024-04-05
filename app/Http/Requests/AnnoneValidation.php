<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnoneValidation extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'images.*' => 'required|file|mimes:jpeg,png,jpg,webp',
            'city' => 'required|string',
            'address' => 'required|string',
            'map' => 'nullable|string',
            'type' => 'required|in:Vente,Location',
            'status' => 'required|in:Neuf,Occasion,Vide,Meublé',
            'category'=> 'required|exists:categories,id',
            'price' => 'required|string',
            'surface' => 'required|integer',
            'bedroom' => 'required_if:category,'.implode(',', [1, 2, 3]).'|integer',
            'bathroom' =>  'required_if:category,'.implode(',', [1, 2, 3]).'|integer',
        ];
    }
    
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'description.required' => 'La description est requise.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'images.required' => 'Le champ Images est requis.',
            'images.*.mimes' => 'Les images doivent être au format jpeg, png, jpg, webp.',
            'city.required' => 'La ville est requise.',
            'city.string' => 'La ville doit être une chaîne de caractères.',
            'address.required' => "L'adresse est requise.",
            'address.string' => "L'adresse doit être une chaîne de caractères.",
            'map.string' => 'La carte doit être une chaîne de caractères.',
            'type.required' => 'Le type est requis.',
            'type.in' => 'Le type doit être "Vente" ou "Location".',
            'status.required' => 'Le statut est requis.',
            'status.in' => 'Le statut doit être "Neuf", "Occasion", "Vide" ou "Meublé".',
            'price.required' => 'Le prix est requis.',
            'price.string' => 'Le prix doit être une chaîne de caractères.',
            'surface.required' => 'La surface est requise.',
            'surface.integer' => 'La surface doit être un entier.',
            'bedroom.required' => 'Le nombre de chambres est requis.',
            'bedroom.integer' => 'Le nombre de chambres doit être un entier.',
            'bathroom.required' => 'Le nombre de salles de bain est requis.',
            'bathroom.integer' => 'Le nombre de salles de bain doit être un entier.',
        ];
    }
    
}
