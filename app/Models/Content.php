<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['judul', 'isi_konten', 'gambar', 'type'];
}
