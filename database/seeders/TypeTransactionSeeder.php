<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Location',
            'Vente',
        ];

        foreach ($types as $type) {
            DB::table('type_transactions')->insert([
                'nametype' => $type,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
