<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeProprieteSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Appartement simple',
            'Appartement meublé',
            'Maison entière',
            'Studio',
            'Terrain',
            'Bureau',
            
        ];

        foreach ($types as $type) {
            DB::table('type_proprietes')->insert([
                'typename' => $type,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
