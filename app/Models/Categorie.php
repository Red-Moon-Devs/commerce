<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'description'  
    ];

    public function produits()
    {
        return $this->hasMany(Produit::class, 'id_categorie');  // Assurez-vous d'utiliser le bon modèle ici
  
}
}
