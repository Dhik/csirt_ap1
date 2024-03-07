<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PanduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('panduans')->insert([
            [
                'filename' => 'Panduan Penanganan Insiden Malware',
                'file' => 'panduan_malware.pdf'
            ],
            [
                'filename' => 'Panduan Penanganan Insiden Serangan DDoS',
                'file' => 'panduan_ddos.pdf'
            ],
            [
                'filename' => 'Panduan Penanganan Insiden Serangan Phishing',
                'file' => 'panduan_phishing.pdf'
            ],
            [
                'filename' => 'Panduan Penanganan Insiden Serangan SQL Injection',
                'file' => 'panduan_sql_injection.pdf'
            ],
            [
                'filename' => 'Panduan Penanganan Insiden Web Defacement',
                'file' => 'panduan_web_defacement.pdf'
            ],
        ]);
    }
}
