<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreProprieteRequest extends FormRequest
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
    'titre' => 'required|string|max:255',
    'description' => 'required|string',
    'adresse' => 'required|string',
    'ville' => 'required|string',
    'prix' => 'required|numeric',
    'surface' => 'required|string',
    'chambres' => 'required|integer',
    'salle_bains' => 'required|integer',
    'statut' => 'in:Disponible,Occupé',
    'type_propriete_id' => 'required|exists:type_proprietes,id',
    'type_transaction_id' => 'required|exists:type_transactions,id',

    // 🔽 Images : maximum 5, chaque fichier doit être une image
    'images' => 'required|array|max:5',
    'images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // max 2 Mo par image
];

}
}
