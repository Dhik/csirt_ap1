<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelapor')->nullable();
            $table->string('nama_pelapor')->nullable();
            $table->string('email')->nullable();
            $table->string('unit')->nullable();
            $table->string('tipe_laporan')->nullable();
            $table->date('waktu_insiden')->nullable();
            $table->string('tipe')->nullable();
            $table->text('deskripsi_insiden')->nullable();
            $table->string('screenshot_insiden')->nullable();
            $table->string('domainname_insiden')->nullable();
            $table->string('url_insiden')->nullable();
            $table->string('email_insiden')->nullable();
            $table->string('dampak_insiden')->nullable();
            $table->text('tindakan_penanggulangan_jangka_pendek')->nullable();
            $table->text('tindakan_penanggulangan_jangka_panjang')->nullable();
            $table->string('berhasil_rencana_backup_system')->nullable();
            $table->string('organisasi_lain_dilaporkan')->nullable();
            $table->text('aset_kritis_terdampak')->nullable();
            $table->string('dampak_insiden_terhadap_aset')->nullable();
            $table->string('jumlah_pengguna_terkena_dampak')->nullable();
            $table->string('dampak_terhadap_ICT')->nullable();
            $table->string('ip_address_penyerang')->nullable();
            $table->string('port_yang_diserang')->nullable();
            $table->string('tipe_serangan')->nullable();
            $table->string('laporan_analisis_log')->nullable();
            $table->string('laporan_forensik')->nullable();
            $table->string('laporan_audit')->nullable();
            $table->string('laporan_analisis_network_traffic')->nullable();
            $table->string('nama_dan_versi_perangkat')->nullable();
            $table->string('lokasi_perangkat')->nullable();
            $table->string('sistem_operasi')->nullable();
            $table->string('terakhir_update_sistem')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('dns_entry')->nullable();
            $table->string('domain_workgroup')->nullable();
            $table->string('perangkat_terhubung_ke_jaringan')->nullable();
            $table->string('perangkat_terhubung_ke_modem')->nullable();
            $table->string('pengamanan_fisik_perangkat')->nullable();
            $table->string('pengamanan_logik_perangkat')->nullable();
            $table->string('perangkat_diputus')->nullable();
            $table->string('status_insiden')->nullable();
            $table->string('pernah_ditawakan_ke_si_krisis')->nullable();
            $table->string('ttd_vp_ti')->nullable();
            $table->string('ttd_tis')->nullable();
            $table->string('ttd_ti_officer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};