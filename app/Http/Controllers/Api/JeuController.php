<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JeuRequest;
use App\Http\Resources\JeuResource;
use App\Models\Jeu;
use Illuminate\Http\Request;

class JeuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jeux = Jeu::all();
        return JeuResource::collection($jeux);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JeuRequest $request)
    {
        // Ici les données ont été validées dans la classe JeuRequest
        $jeu = new Jeu();
        $jeu->nom = $request->nom;
        $jeu->description = $request->description;
        $jeu->langue = $request->langue;
        $jeu->age_min = $request->age_min;
        $jeu->nombre_joueurs_min = $request->nombre_joueurs_min;
        $jeu->nombre_joueurs_max = $request->nombre_joueurs_max;
        $jeu->duree_partie = $request->duree_partie;
        $jeu->categorie = $request->categorie;
        $jeu->theme = $request->theme;
        $jeu->editeur = $request->editeur;
        $jeu->url_media = "url_a_mettre";
        $jeu->save();
        return response()->json([
            'status' => true,
            'message' => "Game Created successfully!",
            'jeu' => $jeu], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jeu = Jeu::findOrFail($id);
        return new JeuResource($jeu);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JeuRequest $request, int $id) {
        $jeu = Jeu::findOrFail($id);
        $jeu->nom = $request->nom;
        $jeu->description = $request->description;
        $jeu->langue = $request->langue;
        $jeu->age_min = $request->age_min;
        $jeu->nombre_joueurs_min = $request->nombre_joueurs_min;
        $jeu->nombre_joueurs_max = $request->nombre_joueurs_max;
        $jeu->duree_partie = $request->duree_partie;
        $jeu->categorie = $request->categorie;
        $jeu->theme = $request->theme;
        $jeu->editeur = $request->editeur;
        $jeu->url_media = "url_a_mettre";
        $jeu->save();
        return response()->json([
            'status' => true,
            'message' => "Game Updated successfully!",
            'jeu' => $jeu
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateUrl(JeuRequest $request, int $id) {
        $jeu = Jeu::findOrFail($id);
        $jeu->update($request->attributes(url_media()));
        return response()->json([
            'status' => true,
            'message' => "Game url updated successfully!",
            'jeu' => $jeu], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
