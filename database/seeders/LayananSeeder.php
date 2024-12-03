<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan dummy data menggunakan DB facade
        DB::table('layanans')->insert([
            [
                'nama_layanan' => 'Layanan A',
                'deskripsi' => 'Deskripsi layanan A yang sangat detail dan informatif.',
            ],
            [
                'nama_layanan' => 'Layanan B',
                'deskripsi' => 'Deskripsi layanan B yang memberikan solusi terbaik.',
            ],
            [
                'nama_layanan' => 'Layanan C',
                'deskripsi' => 'Deskripsi layanan C yang mengedepankan kualitas.',
            ],
            [
                'nama_layanan' => 'Layanan D',
                'deskripsi' => 'Deskripsi layanan D yang memudahkan pengguna.',
            ],
        ]);
    }
}
