<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Profil;
use App\Models\Visi;
use App\Models\Misi;
use App\Models\Struktur;
use App\Models\Aduan;
use App\Models\VA;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function getEvents()
    {
        $events = Event::latest()->get();

        return view('administrator.event', ['events' => $events]);
    }

    public function eventBeranda()
    {
        $events = Event::all();

        return view('user.event', ['events' => $events]);
    }
    public function hubungiKamiBeranda()
    {
        $contacts = Contact::all();

        return view('user.hubungiKami', ['contacts' => $contacts]);
    }

    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdate(Request $request)
    {
        $eventId = $request->input('event_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'name' => 'required|string',
                    'description' => 'required|string',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after:start_date',
                    'location' => 'required|string',
                ]);

                $eventData = $request->only(['name', 'description', 'start_date', 'end_date', 'location']);

                Event::create($eventData);

                return redirect()->route('admin.eventManagement')->with('message', 'Event baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $event = Event::find($eventId);

                $request->validate([
                    'name' => 'string',
                    'description' => 'string',
                    'start_date' => 'date',
                    'end_date' => 'date|after:start_date',
                    'location' => 'string',
                ]);
                $eventData = [
                    'name' =>  $request->name,
                    'description' =>  $request->description,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'location' => $request->location,
                    'judul' => $request->judul,
                    'caption' => $request->caption,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($event->name != $eventData['name'] || $event->description != $eventData['description'] || 
                    $event->start_date != $eventData['start_date'] || $event->end_date != $eventData['end_date'] ||
                    $event->location != $eventData['location']) {
                    
                    $event->update($eventData);

                    return redirect()->route('admin.eventManagement')->with('message', 'Event berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.eventManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.eventManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function delete($id)
    {
        $content = Event::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.eventManagement')->with('message', 'Konten berhasil dihapus');
        }

        return redirect()->route('admin.eventManagement')->with('message', 'Konten tidak ditemukan');
    }



    public function showProfil($id)
    {
        $event = Profil::find($id);

        if (!$event) {
            return response()->json(['error' => 'Profil Company tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdateProfil(Request $request)
    {
        $eventId = $request->input('profil_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'jenis_layanan' => 'required|string',
                    'deskripsi' => 'required|string',
                ]);

                $eventData = $request->only(['jenis_layanan', 'deskripsi']);

                Profil::create($eventData);

                return redirect()->route('admin.profilManagement')->with('message', 'Profil Company baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $event = Profil::find($eventId);

                $request->validate([
                    'jenis_layanan' => 'required|string',
                    'deskripsi' => 'required|string',
                ]);
                $eventData = [
                    'jenis_layanan' =>  $request->jenis_layanan,
                    'deskripsi' =>  $request->deskripsi,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($event->jenis_layanan != $eventData['jenis_layanan'] || $event->deskripsi != $eventData['deskripsi']) {
                    
                    $event->update($eventData);

                    return redirect()->route('admin.profilManagement')->with('message', 'Event berhasil diperbarui');
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
            return redirect()->route('admin.profilManagement')->with('message', 'Profil Company berhasil dihapus');
        }

        return redirect()->route('admin.profilManagement')->with('message', 'Profil Company tidak ditemukan');
    }



    public function showMisi($id)
    {
        $event = Misi::find($id);

        if (!$event) {
            return response()->json(['error' => ' Misi tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdateMisi(Request $request)
    {
        $eventId = $request->input('misi_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'misi' => 'required|string',
                ]);

                $eventData = $request->only(['misi']);

                Misi::create($eventData);

                return redirect()->route('admin.visiMisiManagement')->with('message', 'Misi baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $event = Misi::find($eventId);

                $request->validate([
                    'misi' => 'required|string',
                ]);
                $eventData = [
                    'misi' =>  $request->misi,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($event->misi != $eventData['misi']) {
                    
                    $event->update($eventData);

                    return redirect()->route('admin.visiMisiManagement')->with('message', 'Misi berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.visiMisiManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.visiMisiManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function deleteMisi($id)
    {
        $content = Misi::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.visiMisiManagement')->with('message', 'Misi berhasil dihapus');
        }

        return redirect()->route('admin.visiMisiManagement')->with('message', 'Misi tidak ditemukan');
    }



    public function showVisi($id)
    {
        $event = Visi::find($id);

        if (!$event) {
            return response()->json(['error' => ' Visi tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdateVisi(Request $request)
    {
        $eventId = $request->input('visi_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                echo $request->visi;
            } elseif ($formMethod == "update") {
                $event = Visi::find($eventId);

                $request->validate([
                    'visi' => 'required|string',
                ]);
                $eventData = [
                    'visi' =>  $request->visi,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($event->visi != $eventData['visi']) {
                    
                    $event->update($eventData);

                    return redirect()->route('admin.visiMisiManagement')->with('message', 'isi berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.visiMisiManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.visiMisiManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function deleteVisi($id)
    {
        $content = Visi::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.visiMisiManagement')->with('message', 'Visi berhasil dihapus');
        }

        return redirect()->route('admin.visiMisiManagement')->with('message', 'Visi tidak ditemukan');
    }



    public function showStruktur($id)
    {
        $event = Struktur::find($id);

        if (!$event) {
            return response()->json(['error' => ' Struktur organisasi tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdateStruktur(Request $request)
    {
        $eventId = $request->input('struktur_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if ($request->hasFile('gambar')) {
                    $gambarPath = $request->file('gambar')->store('images', 'public');
                }else{
                    return redirect()->route('admin.strukturManagement')->with('message', 'Input gagal, Gambar wajib diisi');
                }
                Struktur::create([
                    'gambar' => $gambarPath,
                ]);

                return redirect()->route('admin.strukturManagement')->with('message', 'Struktur baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $event = Struktur::find($eventId);

                if (!$event) {
                    return redirect()->route('admin.strukturManagement')->with('message', 'Eror');
                }
                $request->validate([
                    'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                if ($request->hasFile('gambar')) {
                    Storage::disk('public')->delete($event->gambar);
                    $gambarPath = $request->file('gambar')->store('images', 'public');
                    $galleryData['gambar'] = $gambarPath;
                }


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($request->hasFile('gambar') && $gallery->gambar != $galleryData['gambar']) {
                    $event->update($galleryData);

                    return redirect()->route('admin.strukturManagement')->with('message', 'isi berhasil diperbarui');
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
        $gallery = Struktur::find($id);

        if ($gallery) {
            Storage::disk('public')->delete($gallery->gambar);

            $gallery->delete();
            return redirect()->route('admin.strukturManagement')->with('message', 'Berhasil diupdate');
        }

        return redirect()->route('admin.strukturManagement')->with('error', 'Gagal diupdate');
    }


    public function showAduan($id)
    {
        $event = Aduan::find($id);

        if (!$event) {
            return response()->json(['error' => 'Langkah aduan tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdateAduan(Request $request)
    {
        $eventId = $request->input('aduan_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'prosedur' => 'required|string',
                ]);

                $eventData = $request->only(['prosedur']);

                Aduan::create($eventData);

                return redirect()->route('admin.aduanManagement')->with('message', 'Langkah aduan baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $event = Aduan::find($eventId);

                $request->validate([
                    'prosedur' => 'required|string',
                ]);
                $eventData = [
                    'prosedur' =>  $request->prosedur,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($event->prosedur != $eventData['prosedur']) {
                    
                    $event->update($eventData);
                    return redirect()->route('admin.aduanManagement')->with('message', 'Langkah aduan berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.aduanManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.aduanManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function deleteAduan($id)
    {
        $content = Aduan::find($id);
        if ($content) {
            $content->delete();
            return redirect()->route('admin.aduanManagement')->with('message', 'Langkah aduan berhasil dihapus');
        }

        return redirect()->route('admin.aduanManagement')->with('message', 'Langkah aduan tidak ditemukan');
    }



    public function showVA($id)
    {
        $event = VA::find($id);

        if (!$event) {
            return response()->json(['error' => 'Layanan VA tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdateVA(Request $request)
    {
        $eventId = $request->input('va_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'informasi_va' => 'required|string',
                ]);

                $eventData = $request->only(['informasi_va']);

                VA::create($eventData);

                return redirect()->route('admin.layananVAManagement')->with('message', 'Layanan VA baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $event = VA::find($eventId);

                $request->validate([
                    'informasi_va' => 'required|string',
                ]);
                $eventData = [
                    'informasi_va' =>  $request->informasi_va,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($event->informasi_va != $eventData['informasi_va']) {
                    
                    $event->update($eventData);
                    return redirect()->route('admin.layananVAManagement')->with('message', 'Layanan VA berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.layananVAManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.layananVAManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function deleteVA($id)
    {
        $content = VA::find($id);
        if ($content) {
            $content->delete();
            return redirect()->route('admin.layananVAManagement')->with('message', 'Layanan VA berhasil dihapus');
        }

        return redirect()->route('admin.layananVAManagement')->with('message', 'Layanan VA tidak ditemukan');
    }


    public function showContact($id)
    {
        $event = Contact::find($id);

        if (!$event) {
            return response()->json(['error' => 'Contact tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdateContact(Request $request)
    {
        $eventId = $request->input('contact_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'lokasi' => 'required|string',
                    'nomor_hp' => 'required|string',
                    'maps' => 'required|string',
                ]);

                $eventData = $request->only(['lokasi', 'nomor_hp', 'maps']);

                Contact::create($eventData);

                return redirect()->route('admin.hubungiKamiManagement')->with('message', 'Layanan VA baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $event = Contact::find($eventId);

                $request->validate([
                    'lokasi' => 'required|string',
                    'nomor_hp' => 'required|string',
                    'maps' => 'required|string',
                ]);
                $eventData = [
                    'lokasi' =>  $request->lokasi,
                    'nomor_hp' =>  $request->nomor_hp,
                    'maps' =>  $request->maps,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($event->lokasi != $eventData['lokasi'] || 
                $event->nomor_hp != $eventData['nomor_hp'] || 
                $event->maps != $eventData['maps']) {
                    
                    $event->update($eventData);
                    return redirect()->route('admin.hubungiKamiManagement')->with('message', 'Hubungi Kami berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.hubungiKamiManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.hubungiKamiManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function deleteContact($id)
    {
        $content = Contact::find($id);
        if ($content) {
            $content->delete();
            return redirect()->route('admin.hubungiKamiManagement')->with('message', 'Hubungi Kami berhasil dihapus');
        }

        return redirect()->route('admin.hubungiKamiManagement')->with('message', 'Hubungi Kami tidak ditemukan');
    }
}

