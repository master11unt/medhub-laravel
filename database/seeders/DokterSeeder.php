<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert(array(
            array(
                'name' => 'Pasien Satu',
                'email' => 'pasien@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '081234567890',
                'role' => 'user',
                'jenis_kelamin' => 'L',
                'no_ktp' => '7876578989',
                // 'tanggal_lahir' => '1995-04-01',
                // 'image' => 'uploads/users/photo1.jpg'
            ),
            array(
                'name' => 'Dr. Spesialis',
                'email' => 'dokter@gmail.com',
                'password' => Hash::make('dokter'),
                'phone' => '081298765432',
                'role' => 'dokter',
                'jenis_kelamin' => 'P',
                'no_ktp' => '5346743467',
                // 'tanggal_lahir' => '1980-01-15',
                // 'image' => 'uploads/users/photo2.jpg'
            ),
            array(
                'name' => 'Admin MedHub',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'phone' => '081200011122',
                'role' => 'admin',
                'jenis_kelamin' => 'L',
                'no_ktp' => '0987544345',
                // 'tanggal_lahir' => '1990-12-12',
                // 'image' =>'uploads/users/photo3.jpg'
            ),
        ));
    }
}
