<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Création d'un admin
        $admin = User::create([
            'name' => 'Babana',
            'email' => 'admin@gmail.com',
            'address' => 'Tokoin-Séminaire',
            'phone' => '90909090',
            'password' => Hash::make('admin2024'),
            'role' => 'admin',
        ]);

        // Vérification immédiate de l'admin
        $admin->email_verified_at = now();  // Assigner la date actuelle à email_verified_at
        $admin->save();

        // Création d'un gestionnaire
        $gestionnaire = User::create([
            'name' => 'Assuka',
            'email' => 'gestionnaire@gmail.com',
            'address' => 'Avepozo',
            'phone' => '91919191',
            'password' => Hash::make('gestion2024'),
            'role' => 'manager',
        ]);

        // Vérification immédiate du gestionnaire
        $gestionnaire->email_verified_at = now();  // Assigner la date actuelle à email_verified_at
        $gestionnaire->save();
    }
}
