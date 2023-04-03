<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CommentaireRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'commentaire' => "required|string",
            'date_com' => "required",
            'note' => "required|integer",
            'jeu_id' => "required|integer",
            'adherent_id' => "required|integer",
        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator){
        throw new \HttpResponseException(response()->json(json_encode(['message' => 'E R R E U R']), 422));
    }
}
