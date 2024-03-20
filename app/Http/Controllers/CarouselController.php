<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function showCarousels()
    {
        $carousels = Carousel::latest()->get();
        return view('administrator.carousel', compact('carousels'));
    }

   
    public function storeOrUpdate(Request $request)
    {
        $carouselId = $request->input('carousel_id');
        $formMethod = $request->get('formMethod');
    
        try {
            if ($formMethod == "store") {
                $request->validate([
                    'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ]);
    
                $gambarPath = $request->file('image_path')->store('images', 'public');
    
                Carousel::create([
                    'heading_caption' => $request->input('heading_caption'),
                    'caption' => $request->input('caption'),
                    'image_path' => $gambarPath,
                ]);
    
                return redirect()->route('admin.carousel')->with('message', 'Berhasil ditambahkan');
            } elseif ($formMethod === "update") {
                $carousel = Carousel::find($carouselId);
    
                $request->validate([
                    'heading_caption' => 'string',
                    'caption' => 'string',
                    'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ]);
    
                $carouselData = [
                    'heading_caption' => $request->input('heading_caption'),
                    'caption' => $request->input('caption'),
                ];
    
                if ($request->hasFile('image_path')) {
                    Storage::disk('public')->delete($carousel->image_path);
                    $gambarPath = $request->file('image_path')->store('images', 'public');
                    $carouselData['image_path'] = $gambarPath;
                }
    
                // Check if there are changes before updating
                if (
                    $carousel->heading_caption != $carouselData['heading_caption'] ||
                    $carousel->caption != $carouselData['caption'] ||
                    ($request->hasFile('image_path') && $carousel->image_path != $carouselData['image_path'])
                ) {
                    $carousel->update($carouselData);
    
                    return redirect()->route('admin.carousel')->with('message', 'Berhasil diupdate');
                } else {
                    // No changes were made
                    return redirect()->route('admin.carousel')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.carousel')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }
    

    public function show($id)
    {
        $carousel = Carousel::find($id);
    
        if (!$carousel) {
            abort(404);
        }
    
        return response()->json($carousel);
    }

    

    public function delete($id)
    {
        $carousel = Carousel::find($id);

        if ($carousel) {
            $carousel->delete();
            return redirect()->route('admin.carousel')->with('message', 'Berhasil dihapus');
        }

        return redirect()->route('admin.carousel')->with('message', 'Gagal dihapus');
    }
}