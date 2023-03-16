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
        'date_achat' => "required",
        'lieu_achat' => "required|string|between:5,500",
        'prix' => "required|numeric",
    ];
}
    public function messages(): array {
        return [
            'required' => 'Le champ :attribute est obligatoire',
            'string' => 'Le champ :attribute doit être un string.',
            'numeric' => 'Le champ :attribute doit être un numeric.',
          ];
 }

}
