<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profils')->insert([
            [
                'jenis_layanan' => 'Layanan Reaktif',
                'deskripsi' => 'Pemberian peringatan (alerts and warning), penanggulangan dan pemulihan insiden siber (incident handling), penanganan kerawanan (vulnerability handling) dan penanganan bukti insiden (artifact handling).',
            ],
            [
                'jenis_layanan' => 'Layanan Proaktif',
                'deskripsi' => 'Review keamanan siber (cyber security review).',
            ],
            [
                'jenis_layanan' => 'Layanan Manajemen Kualitas Keamanan',
                'deskripsi' => 'Analisis risiko (risk analysis) dan edukasi/pelatihan (education/ training).',
            ],
        ]);
    }
}
