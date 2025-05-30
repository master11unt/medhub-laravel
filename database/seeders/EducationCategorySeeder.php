<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('education_categories')->insert(array(
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
