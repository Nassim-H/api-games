<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class AdherentRequest extends FormRequest
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
            'login' => "required|string",
            'email' => "required|string",
            'password' => "required|string",
            'nom' => "required|string",
            'prenom' => "required|string",
            'pseudo' => "required|string"
        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator){
        throw new \HttpResponseException(response()->json(json_encode(['message' => 'E R R E U R']), 422));
    }
}
