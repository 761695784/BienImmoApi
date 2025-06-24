<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Créer un utilisateurs avec le rôle "admin"
         $user = User::create([
            'nom' => 'Marna',
            'prenom' => 'Malang',
            'tel' =>'+221 777 77 77',
            'adresse' => 'Dakar',
            'email' => 'sendoctrack@gmail.com',
            'password' => Hash::make('adminpassword'),
        ]);
            $user->assignRole('admin');


        // ✅ Créer 2 utilisateurs avec le rôle "owner"
 $users = [
            [
                'nom' => 'Mendy',
                'prenom' => 'Malcom',
                'tel' =>'+221 777 76 77',
                'adresse' => 'Dakar',
                'email' => 'Malcom70976@gmail.com',
                'password' => Hash::make('password123')
            ],
            [
                'nom' => 'Tech',
                'prenom' => 'Majeli',
                'tel' =>'+221 777 78 77',
                'adresse' => 'Dakar',
                'email' => 'majeli061@gmail.com',
                'password' => Hash::make('password1')
            ],

        ];

        //  Créer les utilisateurs et leur assigner le rôle SimpleUser
         foreach ($users as $userData) {
            $user = User::create($userData);
            $user->assignRole('owner'); // Assigner le rôle SimpleUser
        }

    }
}
