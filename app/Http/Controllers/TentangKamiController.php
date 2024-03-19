<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use App\Models\Profil;
use App\Models\Struktur;
use App\Models\Visi;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function getProfil()
    {
        $profils = Profil::latest()->get();

        return view('administrator.profil', ['profils' => $profils]);
    }
    public function showProfil($id)
    {
        $event = Profil::find($id);

        if (!$event) {
            return response()->json(['error' => 'Profil tidak ditemukan'], 404);
        }

        return response()->json($event);
    }
    public function profilBeranda()
    {
        $profils = Profil::all();

        return view('user.profil', ['profils' => $profils]);
    }
    public function storeOrUpdateProfil(Request $request)
    {
        $profilId = $request->input('profil_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'jenis_layanan' => 'required|string',
                    'deskripsi' => 'required|string',
                ]);

                $profilData = $request->only(['jenis_layanan', 'deskripsi']);

                Profil::create($profilData);

                return redirect()->route('admin.profilManagement')->with('message', 'Profil baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $profil = Profil::find($profilId);

                $request->validate([
                    'jenis_layanan' => 'required|string',
                    'deskripsi' => 'required|string',
                ]);
                $profilData = [
                    'jenis_layanan' =>  $request->jenis_layanan,
                    'deskripsi' =>  $request->deskripsi,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($profil->jenis_layanan != $profilData['jenis_layanan'] || $profil->deskripsi != $profilData['deskripsi'] ) {
                    
                    $profil->update($profilData);

                    return redirect()->route('admin.profilManagement')->with('message', 'Profil berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.profilManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.profilManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function deleteProfil($id)
    {
        $content = Profil::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.profilManagement')->with('message', 'Profil berhasil dihapus');
        }

        return redirect()->route('admin.profilManagement')->with('message', 'Profil tidak ditemukan');
    }

    public function getVisiMisi()
    {
        $visis = Visi::latest()->get();
        $misis = Misi::latest()->get();

        return view('administrator.visiMisiManagement',compact('visis', 'misis'));
    }
    public function showVisiMisi($id)
    {
        $visis = Visi::find($id);
        $misis = Misi::find($id);

        if (!$visis) {
            return response()->json(['error' => 'visi tidak ditemukan'], 404);
        }
        if (!$misis) {
            return response()->json(['error' => 'misi tidak ditemukan'], 404);
        }

        return response()->json([$visis,$misis]);
    }
    public function visiMisiBeranda()
    {
        $visis = Visi::all();
        $misis = Misi::all();

        return view('user.visiMisi', compact('visis', 'misis'));
    }
    public function storeOrUpdateVisiMisi(Request $request)
    {
        $profilId = $request->input('profil_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'jenis_layanan' => 'required|string',
                    'deskripsi' => 'required|string',
                ]);

                $profilData = $request->only(['jenis_layanan', 'deskripsi']);

                Profil::create($profilData);

                return redirect()->route('admin.profilManagement')->with('message', 'Profil baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $profil = Profil::find($profilId);

                $request->validate([
                    'jenis_layanan' => 'required|string',
                    'deskripsi' => 'required|string',
                ]);
                $profilData = [
                    'jenis_layanan' =>  $request->jenis_layanan,
                    'deskripsi' =>  $request->deskripsi,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($profil->jenis_layanan != $profilData['jenis_layanan'] || $profil->deskripsi != $profilData['deskripsi'] ) {
                    
                    $profil->update($profilData);

                    return redirect()->route('admin.profilManagement')->with('message', 'Profil berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.profilManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.profilManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function deleteVisiMisi($id)
    {
        $content = Profil::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.profilManagement')->with('message', 'Profil berhasil dihapus');
        }

        return redirect()->route('admin.profilManagement')->with('message', 'Profil tidak ditemukan');
    }
    public function getStruktur()
    {
        $strukturs = Struktur::latest()->get();

        return view('administrator.strukturManagement',compact('strukturs'));
    }
    public function showStruktur($id)
    {
        $strukturs = Struktur::find($id);

        if (!$strukturs) {
            return response()->json(['error' => 'struktur tidak ditemukan'], 404);
        }

        return response()->json([$strukturs]);
    }
    public function strukturBeranda()
    {
        $strukturs = Struktur::all();

        return view('user.struktur', compact('strukturs'));
    }
    public function storeOrUpdateStruktur(Request $request)
    {
        $strukturId = $request->input('struktur_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $strukturData = $request->only(['gambar']);

                Struktur::create($strukturData);

                return redirect()->route('admin.profilManagement')->with('message', 'Profil baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $struktur = Struktur::find($strukturId);

                $request->validate([
                    'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $strukturData = [
                    'gambar' =>  $request->gambar
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($struktur->jenis_layanan != $strukturData['gambar']  ) {
                    
                    $struktur->update($strukturData);

                    return redirect()->route('admin.strukturManagement')->with('message', 'struktur berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.strukturManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.strukturManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function deleteStruktur($id)
    {
        $content = Struktur::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.strukturManagement')->with('message', 'struktur berhasil dihapus');
        }

        return redirect()->route('admin.strukturManagement')->with('message', 'struktur tidak ditemukan');
    }

}

