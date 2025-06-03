<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'name' => 'Cileungsi',
                'address' => 'Jl. Raya Cileungsi'
            ],
            [
                'name' => 'Jonggol',
                'address' => 'Jl. Raya Jonggol'
            ],
            [
                'name' => 'Cibubur',
                'address' => 'Jl. Raya Cibubur'
            ]
        ]);
    }
}