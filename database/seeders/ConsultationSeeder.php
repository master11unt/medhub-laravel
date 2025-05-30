<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consultations')->insert(array(
            array(
                'name' => 'Kendaraan',
                'icon' => '-',
            ),
            array(
                'name' => 'Motor',
                'icon' => '-',
            ),
            array(
                'name' => 'Mobil',
                'icon' => '-',
            ),
        ));
    }
}
