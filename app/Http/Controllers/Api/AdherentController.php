<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdherentResource;
use App\Models\Adherent;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdherentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adherents = User::all();
        return AdherentResource::collection($adherents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $adherent = new User();
        $adherent->email = $request->email;
        $adherent->password = Hash::make($request->password);
        $adherent->valide = true;
        $adherent->nom = $request->nom;
        $adherent->prenom = $request->prenom;
        $adherent->pseudo = $request->pseudo;
        $adherent->email_verified_at = now();
        $adherent->avatar = '../../../../resources/images/avatar1.png';
        $adherent->save();
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
        $adherent= User::findOrFail($id);
        return new AdherentResource($adherent);
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
