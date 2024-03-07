<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;

class ReportsController extends Controller
{
    public function index()
    {
        try {
            $reports = Reports::latest()->get();
            $auth = auth()->user();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return view('administrator.report', compact('reports', 'auth'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $user = User::find($request->user_id);

        $imageName = null;
        if ($request->hasFile('bukti')) {
            $imageName = time() . '.' . $request->bukti->extension();
            $request->bukti->storeAs('images', $imageName, 'public');
        }

        Reports::create([
            'user_id' => $request->user_id,
            'satker' => $request->satker,
            'tanggal' => $request->tanggal,
            'insiden_type' => $request->insiden_type,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'nama_user' => $user->nama_user,
            'status' => $request->status,
            'bukti' => $imageName,
        ]);

        return redirect()->route('admin.reportManagement')->with('message', 'Laporan berhasil ditambahkan');
    }

    public function delete($id)
    {
        $user = Reports::find($id);

        if ($user) {
            try {
                $user->delete();
                return redirect()->route('admin.reportManagement')->with('message', 'User deleted successfully');
            } catch (\Exception $e) {
                return redirect()->route('admin.reportManagement')->with('message', 'Failed to delete user');
            }
        }

        return redirect()->route('admin.reportManagement')->with('message', 'User not found');
    }
    public function deletePelapor($id)
    {
        $user = Reports::find($id);

        if ($user) {
            try {
                $user->delete();
                return redirect()->route('admin.reportManagement')->with('message', 'Deleted successfully');
            } catch (\Exception $e) {
                return redirect()->route('admin.reportManagement')->with('message', 'Failed to delete');
            }
        }

        return redirect()->route('pelapor.reportPelapor')->with('message', 'User not found');
    }
    public function indexPelapor()
    {
        $auth = auth()->user();
        $reports = Reports::where('user_id', $auth->id)
                        ->latest() // Order by the created_at timestamp in descending order
                        ->get();

        return view('pelapor.pelapor', compact('reports', 'auth'));
    }

    public function indexPimpinan()
    {
        try {
            $auth = auth()->user();
            $reports = Reports::all();
    
            return view('pimpinan.dataReport', compact('reports', 'auth'));
        } catch (\Exception $e) {
            // Log or display the error
            dd($e->getMessage());
        }
    }
    

    public function showDashboard()
    {
        $reports = Reports::all();

        $totalPerType = $reports->groupBy('insiden_type')->map->count();
        $totalStatus = $reports->groupBy('status')->map->count();

        return view('pimpinan.dashboard', [
            'totalPerType' => $totalPerType,
            'totalStatus' => $totalStatus,
            'reports' => $reports
        ]);
    }
    public function update(Request $request)
    {
        try {
            $request->validate([
                'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);

            $user = User::find($request->user_id);
            $report = Reports::find($request->report_id);

            // Check if a new image is provided
            if ($request->hasFile('bukti')) {
                // Upload and store the new image
                $imageName = time() . '.' . $request->bukti->extension();
                $request->bukti->storeAs('images', $imageName, 'public');

                // Delete the old image if it exists
                if ($report->bukti) {
                    Storage::disk('public')->delete('images/' . $report->bukti);
                }

                // Update the report with the new image path
                $report->update([
                    'tanggal' => $request->tanggal,
                    'insiden_type' => $request->insiden_type,
                    'keterangan' => $request->keterangan,
                    'penanganan' => $request->penanganan,
                    'status' => $request->status,
                    'bukti' => 'images/' . $imageName,
                ]);

                return back()->with('message', 'Laporan berhasil diperbarui dengan gambar baru');
            } else {
                // No new image provided, check if there are other changes
                if ($report->tanggal != $request->tanggal || 
                    $report->insiden_type != $request->insiden_type ||
                    $report->keterangan != $request->keterangan ||
                    $report->penanganan != $request->penanganan ||
                    $report->status != $request->status) {
                    
                    // Update the report without changing the existing image
                    $report->update([
                        'satker' => $report->satker,
                        'nama_user' => $report->nama_user,
                        'tanggal' => $request->tanggal,
                        'insiden_type' => $request->insiden_type,
                        'keterangan' => $request->keterangan,
                        'penanganan' => $request->penanganan,
                        'status' => $request->status,
                    ]);

                    return back()->with('message', 'Laporan berhasil diperbarui tanpa perubahan gambar');
                } else {
                    // No changes were made
                    return back()->with('message', 'Tidak ada perubahan yang dilakukan pada laporan');
                }
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return back()->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses laporan');
        }
    }


    public function show($id)
    {
        $report = Reports::find($id);
    
        if (!$report) {
            abort(404);
        }
    
        return response()->json($report);
    }

    public function storeOrUpdate(Request $request)
{
    try {
        $request->validate([
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $user = User::find($request->user_id);

        if ($request->formMethod === 'store') {
            return $this->storePelapor($request, $user);
        } elseif ($request->formMethod === 'update') {
            return $this->updatePelapor($request, $user);
        }
    } catch (ValidationException $e) {
        $message = $e->errors();
        return back()->withErrors($message)->withInput();
    } catch (\Exception $e) {
        return back()->with('message', 'An error occurred while processing the request');
    }
}

protected function storePelapor(Request $request, User $user)
{
    try {
        $imageName = $this->uploadImage($request);

        Reports::create([
            'user_id' => $request->user_id,
            'satker' => $request->satker,
            'tanggal' => $request->tanggal,
            'insiden_type' => $request->insiden_type,
            'keterangan' => $request->keterangan,
            'penanganan' => '-',
            'nama_user' => $user->nama_user,
            'status' => $request->status,
            'bukti' => $imageName,
        ]);

        return redirect()->route('pelapor.reportPelapor')->with('message', 'Laporan berhasil ditambahkan');
    } catch (\Exception $e) {
        return redirect()->route('pelapor.reportPelapor')->with('message', 'Input gagal, Periksa kembali inputan ');
    }
}

protected function updatePelapor(Request $request, User $user)
{
    DB::beginTransaction();

    try {
        $report = Reports::find($request->report_id);

        if (!$report) {
            return back()->with('message', 'Laporan tidak ditemukan');
        }

        // Check if a new image is provided
        $imageName = $this->uploadImage($request);

        // Check if there are changes in the report data
        if (
            $report->tanggal == $request->tanggal &&
            $report->insiden_type == $request->insiden_type &&
            $report->keterangan == $request->keterangan &&
            $report->penanganan == $request->penanganan &&
            $report->status == $request->status &&
            !$imageName
        ) {
            // No changes were made
            return back()->with('message', 'Tidak ada perubahan yang dilakukan pada laporan');
        }

        // Update the report data
        $report->update([
            'tanggal' => $request->tanggal,
            'insiden_type' => $request->insiden_type,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'status' => $request->status,
            'bukti' => $imageName,
        ]);

        // Commit the database transaction
        DB::commit();

        return back()->with('message', 'Laporan berhasil diperbarui');
    } catch (\Exception $e) {
        // An error occurred, rollback the database transaction
        DB::rollback();


        return back()->with('message', 'Update gagal, periksa kembali data ');
    }
}


protected function uploadImage(Request $request)
{
    // Check if a new image is provided
    if ($request->hasFile('bukti')) {
        // Upload and store the new image
        return $request->bukti->storeAs('images', time() . '.' . $request->bukti->extension(), 'public');
    }

    return null;
}
public function showReport($id)
    {
        $event = Reports::find($id);

        if (!$event) {
            return response()->json(['error' => 'Laporan tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

}



 