<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdherentResource;
use App\Models\Adherent;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return new AdherentResource($user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $adherent = User::findOrFail($id);
        $adherent->update($request->all());
        return new AdherentResource($adherent);
    }


    public function updateAvatar(Request $request, string $id){
        $adherent = User::findOrFail($id);
        $adherent->avatar = $request->avatar;
        return new AdherentResource($adherent);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
