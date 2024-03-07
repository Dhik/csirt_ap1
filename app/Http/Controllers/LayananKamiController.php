<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\VA;
use Illuminate\Http\Request;

class LayananKamiController extends Controller
{
    public function getAduan()
    {
        $aduans = Aduan::latest()->get();


        return view('administrator.aduanManagement', ['aduans' => $aduans]);
    }
    public function showAduan($id)
    {
        $aduans = Aduan::find($id);

        if (!$aduans) {
            return response()->json(['error' => 'Aduan tidak ditemukan'], 404);
        }

        return response()->json($aduans);
    }
    public function aduanBeranda()
    {
        $aduans = Aduan::all();

        return view('user.aduanSiber', ['aduans' => $aduans]);
    }
    public function getVA()
    {
        $vas = VA::latest()->get();


        return view('administrator.layananVAManagement', ['vas' => $vas]);
    }
    public function showVA($id)
    {
        $vas = VA::find($id);

        if (!$vas) {
            return response()->json(['error' => 'VA tidak ditemukan'], 404);
        }

        return response()->json($vas);
    }
    public function VABeranda()
    {
        $vas = VA::all();

        return view('user.layananVA', ['vas' => $vas]);
    }
    // public function storeOrUpdateProfil(Request $request)
    // {
    //     $profilId = $request->input('profil_id');
    //     $formMethod = $request->get('formMethod');

    //     try {
    //         if ($formMethod == "store") {
    //             $request->validate([
    //                 'jenis_layanan' => 'required|string',
    //                 'deskripsi' => 'required|string',
    //             ]);

    //             $profilData = $request->only(['jenis_layanan', 'deskripsi']);

    //             Profil::create($profilData);

    //             return redirect()->route('admin.profilManagement')->with('message', 'Profil baru berhasil dibuat');
    //         } elseif ($formMethod == "update") {
    //             $profil = Profil::find($profilId);

    //             $request->validate([
    //                 'jenis_layanan' => 'required|string',
    //                 'deskripsi' => 'required|string',
    //             ]);
    //             $profilData = [
    //                 'jenis_layanan' =>  $request->jenis_layanan,
    //                 'deskripsi' =>  $request->deskripsi,
    //             ];


    //             // Periksa apakah ada perubahan sebelum melakukan pembaruan
    //             if ($profil->jenis_layanan != $profilData['jenis_layanan'] || $profil->deskripsi != $profilData['deskripsi'] ) {
                    
    //                 $profil->update($profilData);

    //                 return redirect()->route('admin.profilManagement')->with('message', 'Profil berhasil diperbarui');
    //             } else {
    //                 // Tidak ada perubahan yang dilakukan
    //                 return redirect()->route('admin.profilManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
    //             }
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->route('admin.profilManagement')->with('message', 'Input gagal, isi formulir dengan benar');
    //     }
    // }

    // public function deleteProfil($id)
    // {
    //     $content = Profil::find($id);

    //     if ($content) {
    //         $content->delete();
    //         return redirect()->route('admin.profilManagement')->with('message', 'Profil berhasil dihapus');
    //     }

    //     return redirect()->route('admin.profilManagement')->with('message', 'Profil tidak ditemukan');
    // }

}
