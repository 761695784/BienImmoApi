<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProprieteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public function authorize(): bool
    {
       return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
{
    return [
        'titre' => 'sometimes|string|max:255',
        'description' => 'sometimes|string',
        'adresse' => 'sometimes|string|max:255',
        'ville' => 'sometimes|string|max:100',
        'prix' => 'sometimes|numeric|min:0',
        'surface' => 'sometimes|string|max:100',
        'chambres' => 'sometimes|integer|min:0',
        'salle_bains' => 'sometimes|integer|min:0',
        'statut' => 'sometimes|string|in:Disponible,Occupé',
        'type_propriete_id' => 'sometimes|exists:type_proprietes,id',
        'type_transaction_id' => 'sometimes|exists:type_transactions,id',

        // ajoute d'autres champs si nécessaire
    ];
}

}
