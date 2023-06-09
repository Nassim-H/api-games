<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, mixed>
     *
     */
    use HasFactory;

    protected $fillable = ['nom','description','langue','url_media','age_min','duree_partie','nombre_joueurs_min','nombre_joueurs_max','valide','categorie_id','theme_id','editeur_id'];

    function achats(){
        return $this->hasMany(Achat::class);
    }

    function commentaires(){
        return $this->hasMany(Commentaire::class);
    }

    function categories(){
        return $this->belongsTo(Categories::class);
    }
}
