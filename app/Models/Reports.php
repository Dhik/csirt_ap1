<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'satker',
        'tanggal',
        'insiden_type',
        'keterangan',
        'penanganan',
        'nama_user',
        'status',
        'bukti',
    ];

    // Definisi relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
