<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AchatRequest;
use App\Http\Requests\JeuRequest;
use App\Http\Resources\JeuResource;
use App\Models\Achat;
use App\Models\Categories;
use App\Models\Commentaire;
use App\Models\Editeur;
use App\Models\Jeu;
use App\Models\Like;
use App\Models\Theme;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $editeur = Editeur::where('nom', $request->editeur)->first();
        $theme = Theme::where('nom', $request->theme)->first();
        $categorie = Categories::where('nom', $request->categorie)->first();
        $jeu->nom = $request->nom;
        $jeu->description = $request->description;
        $jeu->langue = $request->langue;
        $jeu->age_min = $request->age_min;
        $jeu->nombre_joueurs_min = $request->nombre_joueurs_min;
        $jeu->nombre_joueurs_max = $request->nombre_joueurs_max;
        $jeu->duree_partie = $request->duree_partie;
        $jeu->categorie_id  = $categorie->id;
        $jeu->theme_id  = $theme->id;
        $jeu->editeur_id  = $editeur->id;
        $jeu->url_media = "url_a_mettre";
        $jeu->save();
        return response()->json([
            'status' => "success",
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
        $editeur = Editeur::where('nom', $request->editeur)->first();
        $theme = Theme::where('nom', $request->theme)->first();
        $categorie = Categories::where('nom', $request->categorie)->first();
        $jeu->nom = $request->nom;
        $jeu->description = $request->description;
        $jeu->langue = $request->langue;
        $jeu->age_min = $request->age_min;
        $jeu->nombre_joueurs_min = $request->nombre_joueurs_min;
        $jeu->nombre_joueurs_max = $request->nombre_joueurs_max;
        $jeu->duree_partie = $request->duree_partie;
        $jeu->categorie_id  = $categorie->id;
        $jeu->theme_id  = $theme->id;
        $jeu->editeur_id  = $editeur->id;
        $jeu->url_media = "url_a_mettre";
        $jeu->save();
        return response()->json([
            'status' => "success",
            'message' => "Game Updated successfully!",
            'jeu' => $jeu
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateUrl(Request $request, int $id) {
        $jeu = Jeu::findOrFail($id);
        $jeu->url_media = $request->url_media;
        return response()->json([
            'status' => "success",
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

    public function achat(AchatRequest $request, int $id)
    {
        $achat = new Achat();
        $achat->date_achat = $request->date_achat;
        $achat->lieu_achat = $request->lieu_achat;
        $achat->prix = $request->prix;
        $achat->adherent_id = Auth::user()->$id;
        $achat->jeux_id= $id;
        $achat->save();
    }
}
