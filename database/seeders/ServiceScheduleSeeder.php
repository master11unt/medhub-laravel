<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_schedules')->insert([
            [
                'service_name' => 'Vaksinasi Gratis',
                'service_description' => 'Program vaksinasi gratis untuk masyarakat',
                'location_id' => 1, // Cileungsi
                'date' => '2025-06-25',
                'time_start' => '08:00:00',
                'time_end' => '11:00:00',
                'terms_and_conditions' => 'Wajib membawa KTP, usia minimal 18 tahun, tidak sedang sakit flu atau demam.',
            ],
            [
                'service_name' => 'Donor Darah',
                'service_description' => 'Donor darah untuk kebutuhan masyarakat',
                'location_id' => 2, // Jonggol
                'date' => '2025-06-26',
                'time_start' => '09:00:00',
                'time_end' => '12:00:00',
                'terms_and_conditions' => 'Wajib membawa KTP, usia minimal 17 tahun, tidak sedang dalam kondisi sakit.',
            ],
            [
                'service_name' => 'Cek Kesehatan',
                'service_description' => 'Pemeriksaan kesehatan gratis untuk umum',
                'location_id' => 3, // Cibubur
                'date' => '2025-06-27',
                'time_start' => '08:30:00',
                'time_end' => '11:30:00',
                'terms_and_conditions' => 'Wajib membawa KTP, tidak sedang dalam kondisi sakit berat.',
            ],
   ]);

    }
}
