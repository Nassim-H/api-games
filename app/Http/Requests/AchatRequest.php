<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AchatRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules() {
    return [
        'nom' => "required|string|between:5,50",
        'description' => "required|string|between:5,500",
        'age_min' => "required|numeric|between:5,65",
        'nombre_joueurs_min' => "required|numeric|between:1,100",
        'nombre_joueurs_max' => "required|numeric|between:1,100",
        'duree_partie' => "required|numeric|between:5,65",
        'categorie' => "required|string",
        'theme' => "required",
        'editeur' => "required",
    ];
}
    public function messages(): array {
        return [
            'required' => 'Le champ :attribute est obligatoire',
            'between' => 'Le champ :attribute doit contenir entre :min et :max caractéres.',
            'age.between' => 'L\'age minimum doit avoir une valeur comprise entre :min et :max.',
            'nombre_joueurs_min.between' => 'Le nombre de joueurs minimum doit avoir une valeur comprise entre :min et :max.',
            'nombre_joueurs_max.between' => 'Le nombre de joueurs maximum doit avoir une valeur comprise entre :min et :max.',
        ];
 }

}
