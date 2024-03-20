<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visis')->insert([
            [
                'visi' => 'Visi AP1-CSIRT adalah mewujudkan pengelolaan keamanan informasi di lingkungan PT. Angkasa Pura I yang sesuai dengan prinsip keamanan informasi yaitu untuk menjamin ketersediaan (availability), keutuhan (integrity), dan kerahasiaan (confidentiality) Aset Informasi PT. Angkasa Pura I.'
            ],
        ]);
    }
}
