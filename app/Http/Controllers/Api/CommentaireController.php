<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commentaires = Commentaire::all();
        return response()->json([
            "status" => "success",
            "message" => "Comment list",
            "comment" => $commentaires
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $commentaire=new Commentaire();
        $commentaire->commentaire = $request->commentaire;
        $commentaire->note = $request->note;
        $commentaire->etat = "public";
        $commentaire->jeu_id= $request->id_jeu;
        $commentaire->user_id = Auth::user()->id;
        $commentaire->save();
        return response()->json([
            "status" => "success",
            "message" => "Comment created successfully",
            "comment" => $commentaire
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update($request->all());

        return response()->json([
            'status' => "success",
            'message' => "Comment updated successfully!",
            'comment' => $commentaire
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->delete();
        return response()->json([
            'status' => "success",
            'message' => "Comment successfully deleted",
        ], 200);
    }
}
