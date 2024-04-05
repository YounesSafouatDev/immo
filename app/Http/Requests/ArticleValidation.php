<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleValidation extends FormRequest
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
            'title'=>'required|string',
            'description'=>'required|string',
            'category'=>'required|integer|exists:categories,id',
            'images.*' => 'required|file|mimes:jpeg,png,jpg,webp'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Le champ Titre est requis.',
            'images.required' => 'Le champ Images est requis.',
            'images.*.mimes' => 'Les images doivent être au format jpeg, png, jpg, webp.',
            'description.required' => 'Le champ Description est requis.',
            'category.required' => 'Le champ Catégorie est requis.',
            'category.exists' => "Catégorie n'existe pas ",
        ];
    }
}
