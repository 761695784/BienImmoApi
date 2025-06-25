<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Propriete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProprieteRequest;
use App\Http\Requests\UpdateProprieteRequest;

class ProprieteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProprieteRequest $request)
    {
     $user = Auth::user();

    $propriete = Propriete::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'adresse' => $request->adresse,
        'ville' => $request->ville,
        'prix' => $request->prix,
        'surface' => $request->surface,
        'chambres' => $request->chambres,
        'salle_bains' => $request->salle_bains,
        'statut' => $request->statut ?? 'Disponible',
        'type_propriete_id' => $request->type_propriete_id,
        'type_transaction_id' => $request->type_transaction_id,
        'user_id' => $user->id,
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('proprietes', 'public');

            Image::create([
                'path' => Storage::url($path), // lien exploitable dans le front
                'propriete_id' => $propriete->id,
            ]);
        }
    }

    return response()->json([
        'message' => 'Propriété créée avec succès.',
        'data' => $propriete->load('images'),
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Propriete $propriete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Propriete $propriete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProprieteRequest $request, Propriete $propriete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Propriete $propriete)
    {
        //
    }
}
