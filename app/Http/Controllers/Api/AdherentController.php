<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdherentController extends FormRequest
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $adherent = new Adherent();
        $adherent->login = $request->login;
        $adherent->email = $request->email;
        $adherent->password = $request->password;
        $adherent->valide = true;
        $adherent->nom = $request->nom;
        $adherent->prenom = $request->prenom;
        $adherent->pseudo = $request->pseudo;
        $adherent->avatar = '../../../../resources/images/avatar1.png';
        return response()->json([
            "status" => "success",
            "message" => "Adherent created successfully",
            "adherent" => $adherent,
            "authorisation" => [
                "token" => "valeur du token",
                "type" => "bearer",
            ]
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
