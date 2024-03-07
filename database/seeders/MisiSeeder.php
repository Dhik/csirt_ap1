<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('misis')->insert([
            [
                'misi' => 'Mendorong kegiatan pengamanan informasi dan pencegahan insiden keamanan informasi.',
            ],
            [
                'misi' => 'Membangun kesadaran keamanan informasi pada sumber daya manusia di lingkungan PT. Angkasa Pura I.',
            ],
            [
                'misi' => 'Menjamin keamanan informasi pada aset informasi PT. Angkasa Pura I.',
            ],
            [
                'misi' => 'Melaksanakan evaluasi secara berkala keandalan sistem keamanan teknologi informasi di lingkungan PT. Angkasa Pura I.',
            ],
            [
                'misi' => 'Meningkatkan kompetensi dan kapasitas sumber daya penanggulangan dan pemulihan keamanan siber di lingkungan PT. Angkasa Pura I.',
            ],
        ]);
    }
}
