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
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

class JeuController extends Controller
{

    /**
     * @OA\Get(
     *     path="/jeux",
     *     summary="Afficher une liste de jeux",
     *     tags={"Jeux"},
     *     @OA\Parameter(
     *         name="nb_joueurs_min",
     *         in="query",
     *         description="Nombre minimum de joueurs",
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="nb_joueurs_max",
     *         in="query",
     *         description="Nombre maximum de joueurs",
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="duree",
     *         in="query",
     *         description="Durée de la partie",
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="age",
     *         in="query",
     *         description="Âge minimum",
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="editeur",
     *         in="query",
     *         description="ID de l'éditeur",
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="theme",
     *         in="query",
     *         description="ID du thème",
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="categorie",
     *         in="query",
     *         description="ID de la catégorie",
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Tri par nom (asc ou desc)",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Renvoie une liste de jeux",
     *
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     * /**
     * @OA\Info(
     *   title="My first API",
     *   version="1.0.0",
     *   @OA\Contact(
     *     email="support@example.com"
     *   )
     * )
     */

    public function index(Request $request)
    {
        $nb_joueurs_min = $request->input('nb_joueurs_min');
        $nb_joueurs_max = $request->input('nb_joueurs_max');
        $duree = $request->input('duree');
        $age = $request->input('age');
        $editeur = $request->input('editeur');
        $theme = $request->input('theme');
        $categorie = $request->input('categorie');
        $sortnom = $request->input('sortNom');
        $sortage = $request->input('sortAge');
        $sortduree = $request->input('sortDuree');

        $jeux = Jeu::all();

        // Utiliser la valeur du paramètre dans votre logique de traitement
        if ($nb_joueurs_min) {
            // Effectuer une requête en utilisant la valeur du paramètre
            $jeux = Jeu::where('nombre_joueurs_min', '=', $nb_joueurs_min)->get();
        } if ($nb_joueurs_max) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::where('nombre_joueurs_max', '=', $nb_joueurs_max)->get();
        }  if ($age) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::where('age_min', '>=', $age)->get();
        }
        if ($duree) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::where('duree_partie', '=', $duree)->get();
        }  if ($editeur) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::where('editeur_id', '=', $editeur)->get();
        }  if ($theme) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::where('theme_id', '=', $theme)->get();
        }  if ($categorie) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::where('categorie_id', '=', $categorie)->get();
        }  if ($sortnom) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::orderBy('nom', $sortnom)->get();
        }
        if ($sortage) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::orderBy('age_min', $sortage)->get();
        }
        if ($sortduree) {
            // Si le paramètre n'est pas présent, obtenir tous les jeux
            $jeux = Jeu::orderBy('duree_partie', $sortduree)->get();
        }




        // Retourner la collection de jeux en utilisant la ressource JeuResource
        return JeuResource::collection($jeux->all());

    }

    public function randomIndex()
    {
        $jeux = Jeu::all()->random(10);
        return JeuResource::collection($jeux);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JeuRequest $request)
    {
        // Ici les données ont été validées dans la classe JeuRequest
        $jeu = new Jeu();
        $editeur = Editeur::where('id', $request->editeur)->first();
        $theme = Theme::where('id', $request->theme)->first();
        $categorie = Categories::where('id', $request->categorie)->first();
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
        $theme = Theme::where('id', $request->theme)->first();
        $categorie = Categories::where('id', $request->categorie)->first();
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
        $achat->user_id = Auth::user()->id;
        $achat->jeu_id= $id;
        $achat->save();
        return response()->json([
            "status"=> "success",
             "message"=> "Purchase created successfully",
             "achat"=>$achat,
            'adherent' => User::all()->where('id', Auth::user()->id),
            ], 200);
    }

    public function destroyAchat(string $id_jeu)
    {
        $achat = Achat::where('jeu_id', $id_jeu)->first()::where('user_id', Auth::user()->id)->first();
        $achat->delete();
        return response()->json([
            "status"=> "success",
            "message"=> "Purchase deleted successfully",
            "achat"=>$achat,
        ], 200);
    }



    public function details(string $id)
    {
        $jeu = Jeu::findOrFail($id);
        $like = Like::where('jeu_id', $id)->first();

        return response()->json([
            "status"=> "success",
            "message"=>"Full info of game",
            "jeu"=> $jeu,
            "achats"=> Achat::all()->where('jeu_id', $id),
            "nb_likes"=> $like->count()??0,
            "note_moyenne" => $jeu->commentaires->avg('note')
        ], 200);

    }

    public function prix_moyen($id){
        $jeu = Jeu::findOrFail($id);
        $prix_moyen = $jeu->achats->avg('prix');
        return response()->json([
            "status"=> "success",
            "message"=>"Prix moyen",
            "prix_moyen"=> $prix_moyen,
        ], 200);
    }

    public function commentaire_jeu($id){
        $commentaires = Commentaire::all()->where('jeu_id', $id);
        return response()->json([
            "status"=> "success",
            "message"=>"Commentaires du jeu",
            "commentaires"=> $commentaires,
        ], 200);
    }
}
