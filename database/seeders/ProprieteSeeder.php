<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propriete;
use App\Models\User;
use App\Models\TypePropriete;
use App\Models\TypeTransaction;

class ProprieteSeeder extends Seeder
{
    public function run(): void
    {
        $owners = User::role('owner')->get();
        $typesPropriete = TypePropriete::all();
        $typesTransaction = TypeTransaction::all();

        // 🏠 On crée 10 biens aléatoires
        for ($i = 1; $i <= 10; $i++) {
            Propriete::create([
                'titre' => "Bien #$i",
                'description' => "Description du bien numéro $i",
                'adresse' => "Adresse $i",
                'ville' => "Dakar",
                'prix' => rand(100000, 1000000),
                'surface' => rand(30, 200),
                'chambres' => rand(1, 5),
                'salle_bains' => rand(1, 3),
                'statut' => 'disponible',
                'user_id' => $owners->random()->id,
                'type_propriete_id' => $typesPropriete->random()->id,
                'type_transaction_id' => $typesTransaction->random()->id,
            ]);
        }
    }
}
