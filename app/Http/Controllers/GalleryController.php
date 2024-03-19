<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();

        return view('administrator.galeryManagement', compact('galleries'));
    }

    public function storeOrUpdate(Request $request)
    {
        $galleryId = $request->input('gallery_id');

        $formMethod = $request->get('formMethod');
        try {
            if ($formMethod == "store") {
                $request->validate([
                    'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);


                if ($request->hasFile('gambar')) {
                    $gambarPath = $request->file('gambar')->store('images', 'public');
                }else{
                    return redirect()->route('admin.galeryManagement')->with('message', 'Input gagal, Gambar wajib diisi');
                }
                Gallery::create([
                    'judul' => $request->judul,
                    'caption' => $request->caption,
                    'gambar' => $gambarPath,
                ]);

                return redirect()->route('admin.galeryManagement')->with('message', 'Berhasil ditambahkan');
            } elseif ($formMethod == "update") {
                $gallery = Gallery::find($galleryId);
                if (!$gallery) {
                    return redirect()->route('admin.galeryManagement')->with('message', 'Eror');
                }
                $request->validate([
                    'judul' => 'required|string',
                    'caption' => 'required|string',
                    'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $galleryData = [
                    'judul' => $request->judul,
                    'caption' => $request->caption,
                ];

                if ($request->hasFile('gambar')) {
                    Storage::disk('public')->delete($gallery->gambar);
                    $gambarPath = $request->file('gambar')->store('images', 'public');
                    $galleryData['gambar'] = $gambarPath;
                }
                if ($gallery->judul != $galleryData['judul'] || $gallery->caption != $galleryData['caption'] || ($request->hasFile('gambar') && $gallery->gambar != $galleryData['gambar'])) {
                    $gallery->update($galleryData);
                    return redirect()->route('admin.galeryManagement')->with('message', 'Berhasil diupdate');
                } else {
                    // No changes were made
                    return redirect()->route('admin.galeryManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.galeryManagement')->with('message', 'Input Gagal, Isi Form Dengan Benar');
        }
    }

    public function delete($id)
    {
        $gallery = Gallery::find($id);

        if ($gallery) {
            Storage::disk('public')->delete($gallery->gambar);

            $gallery->delete();
            return redirect()->route('admin.galeryManagement')->with('message', 'Berhasil diupdate');
        }

        return redirect()->route('admin.galeryManagement')->with('error', 'Gagal diupdate');
    }

    public function getGaleri()
    {
        $galleries = Gallery::all();

        return view('user.beranda', compact('galleries'));
    }

    public function showGalery($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            abort(404);
        }

        $prevGallery = Gallery::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextGallery = Gallery::where('id', '>', $id)->orderBy('id')->first();

        return view('user.galery', compact('gallery', 'prevGallery', 'nextGallery'));
    }
    public function show($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            abort(404);
        }

        return response()->json($gallery);
    }

}