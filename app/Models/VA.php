<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VA extends Model
{

    protected $table = 'vas';
    use HasFactory;
    protected $fillable = ['informasi_va'];
}
