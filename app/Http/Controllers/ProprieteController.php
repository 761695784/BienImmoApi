<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Propriete;
use Illuminate\Support\Facades\Log;
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
        $proprietes = Propriete::with(['images', 'typepropriete', 'typetransaction', 'user'])
            ->latest()
            ->get();

        return response()->json([
            'data' => $proprietes
        ]);
    }

    public function indexPublic()
    {
        $proprietes = Propriete::where('statut', 'Disponible')
            ->with(['images', 'typepropriete', 'typetransaction']) // facultatif : pour enrichir les infos
            ->latest()
            ->get();

        return response()->json([
            'data' => $proprietes
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function indexForOwner()
    {
        $user = Auth::user();

        $proprietes = Propriete::where('user_id', $user->id)
            ->with('images')
            ->latest()
            ->get();

        return response()->json([
            'data' => $proprietes
        ]);
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
        $propriete->load(['images', 'typepropriete', 'typetransaction', 'user']);

        return response()->json([
            'data' => $propriete
        ]);
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
        if (auth()->id() !== $propriete->user_id) {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier ce bien.'], 403);
        }

        // Mise à jour partielle avec les champs présents
        $propriete->update($request->only(array_keys($request->validated())));
        $propriete->refresh();

        return response()->json([
            'message' => 'Bien mis à jour avec succès.',
            'data' => $propriete
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Propriete $propriete)
    {
        $user = auth()->user();

        // Si ce n'est pas le owner et pas un admin, on refuse
        if ($user->id !== $propriete->user_id && $user->role !== 'admin') {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à supprimer ce bien.'], 403);
        }

        $propriete->delete();

        return response()->json([
            'message' => 'Bien supprimé avec succès.'
        ]);
    }

}
