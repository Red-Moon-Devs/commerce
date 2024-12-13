<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin/Users.index', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete(); 

        return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}
