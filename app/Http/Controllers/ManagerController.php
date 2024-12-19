<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        // Logique pour afficher la vue du tableau de bord du gestionnaire
        return view('manager.dashboard'); // Assurez-vous que cette vue existe
    }
}
