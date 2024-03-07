<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    public $table = 'incidents';

    protected $fillable = [
        'id_pelapor',
        'nama_pelapor',
        'email',
        'unit',
        'tipe_laporan',
        'waktu_insiden',
        'tipe',
        'deskripsi_insiden',
        'screenshot_insiden',
        'domainname_insiden',
        'url_insiden',
        'email_insiden',
        'dampak_insiden',
        'tindakan_penanggulangan_jangka_pendek',
        'tindakan_penanggulangan_jangka_panjang',
        'berhasil_rencana_backup_system',
        'organisasi_lain_dilaporkan',
        'aset_kritis_terdampak',
        'dampak_insiden_terhadap_aset',
        'jumlah_pengguna_terkena_dampak',
        'dampak_terhadap_ICT',
        'ip_address_penyerang',
        'port_yang_diserang',
        'tipe_serangan',
        'laporan_analisis_log',
        'laporan_forensik',
        'laporan_audit',
        'laporan_analisis_network_traffic',
        'nama_dan_versi_perangkat',
        'lokasi_perangkat',
        'sistem_operasi',
        'terakhir_update_sistem',
        'ip_address',
        'mac_address',
        'dns_entry',
        'domain_workgroup',
        'perangkat_terhubung_ke_jaringan',
        'perangkat_terhubung_ke_modem',
        'pengamanan_fisik_perangkat',
        'pengamanan_logik_perangkat',
        'perangkat_diputus',
        'status_insiden',
        'pernah_ditawakan_ke_si_krisis',
        'ttd_vp_ti',
        'ttd_tis',
        'ttd_ti_officer',
    ];
}