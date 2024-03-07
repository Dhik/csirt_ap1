<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Foreign key to link with users table
            $table->string('satker');
            $table->date('tanggal');
            $table->string('insiden_type');
            $table->text('keterangan');
            $table->text('penanganan');
            $table->string('nama_user'); // Add nama_user field
            $table->string('status');
            $table->string('bukti')->nullable(); // Assuming you want to store the image file name
            $table->timestamps();
        });

        // Populate satker and nama_user fields based on user_id in users table
        $reports = DB::table('reports')
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->select('reports.id', 'users.role_user as satker', 'users.nama_user')
            ->get();

        foreach ($reports as $report) {
            DB::table('reports')
                ->where('id', $report->id)
                ->update([
                    'satker' => $report->satker,
                    'nama_user' => $report->nama_user,
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
}

