<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vas')->insert([
            [
                'informasi_va' => 'Nama Aplikasi/Website yang akan di VA.'
            ],
            [
                'informasi_va' => 'PIC aplikasi/website (No. HP & Email).'
            ],
            [
                'informasi_va' => 'Target IP/Domain.'
            ],
            [
                'informasi_va' => 'Upload surat permohonan dari satker kepada CSIRT Angkasa Pura I.'
            ],
        ]);
    }
}
