<?php

// app/Http/Controllers/PanduanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panduan;

class PanduanController extends Controller
{
    public function index()
    {
        // Ambil semua data panduan dari database
        $panduans = Panduan::all();

        // Kirim data panduan ke view 'panduan.index'
        return view('user.panduan', compact('panduans'));
    }
    public function detail($filename)
    {
        // Cari panduan berdasarkan nama file
        $panduans = Panduan::where('filename', $filename)->first();
        // dd('awal');

        if ($panduans) {
            // Jika panduan ditemukan, kirim data panduan ke tampilan
            // dd("masuk");
            return view('user.detailPanduan', ['panduans' => $panduans]);
        } else {
            // Jika panduan tidak ditemukan, kembalikan respons 404
            
            // dd("gamasuk");
            abort(404);
        }
    }
}
