<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
       // Récupérer toutes les catégories avec les produits associés
        $categories = Categorie::with('produits')->get();
        
        // Calculer le nombre total de produits
        $totalProduits = Produit::count();

        // Retourner la vue avec les catégories et le nombre total de produits
        return view('admin.categories.list_categorie', compact('categories', 'totalProduits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('admin.categories.ajout_categorie');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        // Valider les données
        $validatedData = $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);
    
        // Vérifier si le libellé existe déjà (insensible à la casse)
        $existingCategorie = categorie::whereRaw('LOWER(libelle) = ?', [strtolower($request->libelle)])->first();
    
        if ($existingCategorie) {
            // Si une catégorie existe avec ce libellé, renvoyer un message d'erreur
            return redirect()->back()->with('error', 'La catégorie existe déjà.');
        }
    
        // Créer la nouvelle catégorie
        categorie::create([
            'libelle' => $request->libelle,
            'description' => $request->description,
        ]);
    
        // Rediriger avec un message de succès
        return redirect()->route('categories.index')->with('success', 'Catégorie créée !');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation des données envoyées
        $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);
    
        // Vérifier si le nouveau libellé existe déjà pour une autre catégorie
        $existingCategorie = Categorie::whereRaw('LOWER(libelle) = ?', [strtolower($request->libelle)])
            ->where('id', '!=', $id) // Exclure la catégorie actuelle
            ->first();
    
        if ($existingCategorie) {
            // Si une catégorie existe déjà avec ce libellé, renvoyer un message d'erreur
            return redirect()->back()->with('error', 'Une autre catégorie avec ce libellé existe déjà.');
        }
    
        // Trouver la catégorie par son ID
        $categorie = Categorie::findOrFail($id);
    
        // Mettre à jour les informations de la catégorie
        $categorie->libelle = $request->input('libelle');
        $categorie->description = $request->input('description');
    
        // Enregistrer les modifications dans la base de données
        $categorie->save();
    
        // Retourner à la page précédente avec un message de succès
        return redirect()->route('categories.index')->with('success', 'La catégorie a été mise à jour avec succès.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Trouver la catégorie par son ID
        $categorie = Categorie::findOrFail($id);

        // Supprimer la catégorie
        $categorie->delete();

        // Rediriger avec un message de succès
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimé ');
    }
}


