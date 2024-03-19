<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('aduans')->insert([
            [
                'prosedur' => 'Penerimaan aduan insiden siber melalui telepon (021) 6541961 ext.2161 atau surel csirt@ap1.co.id. ',
            ],
            [
                'prosedur' => 'Pencatatan aduan insiden siber baik identitas pelapor disertai data dukung dan bukti terjadinya insiden siber. ',
            ],
            [
                'prosedur' => 'Notifikasi penerimaan aduan insiden siber.',
            ],
            [
                'prosedur' => 'Verifikasi aduan insiden siber.',
            ],
            [
                'prosedur' => 'Observasi dan investigasi aduan insiden siber.',
            ],
            [
                'prosedur' => 'Pemberian rekomendasi cara penanggulanangan insiden siber.',
            ],
            [
                'prosedur' => 'Jika administrator IT/pemilik aset tidak dapat menyelesaikan insiden siber dapat meminta BSSN untuk dapat membantu menindaklanjuti aduan insiden siber',
            ],
        ]);
    }
}
