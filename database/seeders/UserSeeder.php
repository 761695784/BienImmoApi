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
            'email' => 'sendoctrack@gmail.com',
            'password' => Hash::make('adminpassword'),
        ]);
            $user->assignRole('admin');


        // ✅ Créer 2 utilisateurs avec le rôle "owner"
 $users = [
            [
                'nom' => 'Mendy',
                'prenom' => 'Malcom',
                'email' => 'Malcom70976@gmail.com',
                'password' => Hash::make('password123')
            ],
            [
                'nom' => 'Tech',
                'prenom' => 'Majeli',
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
