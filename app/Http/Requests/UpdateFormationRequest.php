<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateFormationRequest extends FormRequest
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
            'libelle' => 'required',
            'description' => 'required',
            'debut_candidature' => 'required|date',
            'fin_candidature' => 'required|date',
            'image' => 'sometimes|image|max:10000|mimes:jpeg,png,jpg',
            "duree"=>"required"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => true,
            'message' => 'erreur de validation',
            'errorLists' => $validator->errors(),
        ]));
    }

        public function messages()
    {
        return [
            'libelle.required' => 'le libelle doit être fourni',
            'duree.required' => 'le libelle doit être fourni',
            'decription.required' => 'la description doit être fourni',
            'debut_candidature.required' => 'le debouche doit être fourni',
            'date_publication.required' => 'la date est requis pour debut candidature',
            'fin_candidature.required'=>'date requise pour la fin de candidature',
            'image.image' => 'Seul les images sont autorisés',
            'image.max' => 'La taille de l\'image est trop grand 50 mo max',
            'image.mimes' => "L'image est invalide",
        ];
    }
}
