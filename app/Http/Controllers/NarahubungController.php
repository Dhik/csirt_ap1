<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Incident;
use Illuminate\Http\Client\RequestException;

class NarahubungController extends Controller
{
    public function index()
    {
        try {
            // Retrieving reports and user authentication data
            $reports = Reports::latest()->get();
            $auth = auth()->user();
        } catch (Exception $e) {
            // If an error occurs, store the error message in a variable
            $errorMessage = $e->getMessage();
        }
        return view('narahubung.Narahubung', compact('reports', 'auth'));
    }
    public function sdp()
    {
        try {
            $url = 'https://sdp.ap1.co.id/api/v3/requests';

            $response = Http::withToken('1000.df35a3b3b1c3e81026c138fb374044df.18dad7076dc18a436748fde357811345')
                ->withHeaders([
                    'Authorization' => 'Bearer',
                    'Authtoken' => '372E6BC9-C1B3-42B2-A289-33419DFDFE30',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ])->get($url);

            $requests = $response->json();
            $requests = $requests['requests'];
            // return response()->json($requests);

            return view('narahubung.sdp', compact('requests'));
        } catch (Exception $e) {
            // If an error occurs, store the error message in a variable
            $errorMessage = $e->getMessage();

            // Pass the error message to the Blade view
            return view('narahubung.sdp', compact('errorMessage'));
        }
    }
    public function get_sdp_by_id($id)
    {
        try {
            $url = 'https://sdp.ap1.co.id/api/v3/requests/'.$id;

            $response = Http::withToken('1000.df35a3b3b1c3e81026c138fb374044df.18dad7076dc18a436748fde357811345')
                ->withHeaders([
                    'Authorization' => 'Bearer',
                    'Authtoken' => '372E6BC9-C1B3-42B2-A289-33419DFDFE30',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ])->get($url);

            $requests = $response->json();

            return response()->json($requests['request']);
        } catch (Exception $e) {
            // If an error occurs, store the error message in a variable
            $errorMessage = $e->getMessage();

            // Pass the error message to the Blade view
            return view('narahubung.sdp', compact('errorMessage'));
        }
    }
    public function insiden()
    {
        $reports = Reports::latest()->get();
        $auth = auth()->user();
        $incidents = Incident::latest()->get();

        // Pass the error message to the Blade view
        return view('narahubung.insiden', compact('reports', 'auth', 'incidents'));
    }
    public function form_create()
    {
        return view('narahubung.create_insiden');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        // $validatedData = $request->validate([
        //     'id_pelapor' => 'string',
        //     'nama_pelapor' => 'string',
        //     'email' => 'email',
        //     'unit' => 'string',
        //     'tipe_laporan' => 'in:awal,tindak lanjut,akhir',
        //     'waktu_insiden' => 'date',
        //     'tipe' => 'string',
        //     'deskripsi_insiden' => 'string',
        //     'screenshot_insiden' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'domainname_insiden' => 'string',
        //     'url_insiden' => 'url',
        //     'email_insiden' => 'email',
        //     'dampak_insiden' => 'string',
        //     'tindakan_jangka_pendek' => 'string',
        //     'tindakan_jangka_panjang' => 'string',
        //     'berhasil_rencana_backup' => 'string',
        //     'organisasi_lain_dilaporkan' => 'string',
        //     'aset_kritis_terdampak' => 'string',
        //     'dampak_insiden_terhadap_aset' => 'string',
        //     'jumlah_pengguna_terkena_dampak' => 'string',
        //     'dampak_terhadap_ICT' => 'string',
        //     'ip_address_penyerang' => 'ip',
        //     'port_yang_diserang' => 'string',
        //     'tipe_serangan' => 'string',
        //     'laporan_analisis_log' => 'in:ada,tidak ada,sedang proses',
        //     'laporan_forensik' => 'in:ada,tidak ada,sedang proses',
        //     'laporan_audit' => 'in:ada,tidak ada,sedang proses',
        //     'laporan_analisis_network_traffic' => 'in:ada,tidak ada,sedang proses',
        //     'nama_dan_versi_perangkat' => 'string',
        //     'lokasi_perangkat' => 'string',
        //     'sistem_operasi' => 'string',
        //     'terakhir_update_sistem' => 'date',
        //     'ip_address' => 'ip',
        //     'mac_address' => 'string',
        //     'dns_entry' => 'string',
        //     'domain_workgroup' => 'string',
        //     'terhubung_ke_jaringan' => 'string|in:ya,tidak',
        //     'terhubung_ke_modem' => 'string|in:ya,tidak',
        //     'pengamanan_fisik' => 'string|in:ya,tidak',
        //     'pengamanan_logik' => 'string|in:ya,tidak',
        //     'perangkat_diputus' => 'string|in:ya,tidak',
        //     'status_insiden' => 'string',
        //     'pernah_ditawarkan_ke_si_krisis' => 'string',
        //     'ttd_vp_ti' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'ttd_tis' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'ttd_ti_officer' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // Create a new incident instance
        $incident = new Incident();

        $incident->id_pelapor = $request->id_pelapor;
        $incident->nama_pelapor = $request->nama_pelapor;
        $incident->email = $request->email;
        $incident->unit = $request->unit;
        $incident->tipe_laporan = $request->tipe_laporan;
        $incident->waktu_insiden = $request->waktu_insiden;
        $incident->tipe = $request->tipe;
        $incident->deskripsi_insiden = $request->deskripsi_insiden;
        // Assuming you have a field for file upload named 'screenshot_insiden'
        if ($request->hasFile('screenshot_insiden')) {
            $incident->screenshot_insiden = $request->file('screenshot_insiden')->store('images', 'public');
        } else {
            $incident->screenshot_insiden = '';
        }
        $incident->domainname_insiden = $request->domainname_insiden;
        $incident->url_insiden = $request->url_insiden;
        $incident->email_insiden = $request->email_insiden;
        $incident->dampak_insiden = $request->dampak_insiden;
        $incident->tindakan_penanggulangan_jangka_pendek = $request->tindakan_jangka_pendek;
        $incident->tindakan_penanggulangan_jangka_panjang = $request->tindakan_jangka_panjang;
        $incident->berhasil_rencana_backup_system = $request->berhasil_rencana_backup;
        $incident->organisasi_lain_dilaporkan = $request->organisasi_lain_dilaporkan;
        $incident->aset_kritis_terdampak = $request->aset_kritis_terdampak;
        $incident->dampak_insiden_terhadap_aset = $request->dampak_insiden_terhadap_aset;
        $incident->jumlah_pengguna_terkena_dampak = $request->jumlah_pengguna_terkena_dampak;
        $incident->dampak_terhadap_ICT = $request->dampak_terhadap_ICT;
        $incident->ip_address_penyerang = $request->ip_address_penyerang;
        $incident->port_yang_diserang = $request->port_yang_diserang;
        $incident->tipe_serangan = $request->tipe_serangan;
        $incident->laporan_analisis_log = $request->laporan_analisis_log;
        $incident->laporan_forensik = $request->laporan_forensik;
        $incident->laporan_audit = $request->laporan_audit;
        $incident->laporan_analisis_network_traffic = $request->laporan_analisis_network_traffic;
        $incident->nama_dan_versi_perangkat = $request->nama_dan_versi_perangkat;
        $incident->lokasi_perangkat = $request->lokasi_perangkat;
        $incident->sistem_operasi = $request->sistem_operasi;
        $incident->terakhir_update_sistem = $request->terakhir_update_sistem;
        $incident->ip_address = $request->ip_address;
        $incident->mac_address = $request->mac_address;
        $incident->dns_entry = $request->dns_entry;
        $incident->domain_workgroup = $request->domain_workgroup;
        $incident->perangkat_terhubung_ke_jaringan = $request->terhubung_ke_jaringan;
        $incident->perangkat_terhubung_ke_modem = $request->terhubung_ke_modem;
        $incident->pengamanan_fisik_perangkat = $request->pengamanan_fisik;
        $incident->pengamanan_logik_perangkat = $request->pengamanan_logik;
        $incident->perangkat_diputus = $request->perangkat_diputus;
        $incident->status_insiden = $request->status_insiden;
        $incident->pernah_ditawakan_ke_si_krisis = $request->pernah_ditawarkan_ke_si_krisis;
        // Assuming you have fields for file upload for ttd_vp_ti, ttd_tis, and ttd_ti_officer
        if ($request->hasFile('ttd_vp_ti')) {
            $incident->ttd_vp_ti = $request->file('ttd_vp_ti')->store('images', 'public');
        } else {
            $incident->ttd_vp_ti = '';
        }
        if ($request->hasFile('ttd_tis')) {
            $incident->ttd_tis = $request->file('ttd_tis')->store('images', 'public');
        } else {
            $incident->ttd_tis = '';
        }
        if ($request->hasFile('ttd_ti_officer')) {
            $incident->ttd_ti_officer = $request->file('ttd_ti_officer')->store('images', 'public');
        } else {
            $incident->ttd_ti_officer = '';
        }
        // $incident->ttd_vp_ti = '';
        // $incident->ttd_tis = '';
        // $incident->ttd_ti_officer = '';

        if ($incident->save()) {
            // Redirect the user to a success page with a success message
            return redirect()->route('insiden')->with('success', 'Incident created successfully.');
        } else {
            // Redirect the user back with an error message if saving fails
        }
    }

    public function storeByID(Request $request, $id)
    {
        // Validate the incoming request data
        // $validatedData = $request->validate([
        //     'id_pelapor' => 'string',
        //     'nama_pelapor' => 'string',
        //     'email' => 'email',
        //     'unit' => 'string',
        //     'tipe_laporan' => 'in:awal,tindak lanjut,akhir',
        //     'waktu_insiden' => 'date',
        //     'tipe' => 'string',
        //     'deskripsi_insiden' => 'string',
        //     'screenshot_insiden' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'domainname_insiden' => 'string',
        //     'url_insiden' => 'url',
        //     'email_insiden' => 'email',
        //     'dampak_insiden' => 'string',
        //     'tindakan_jangka_pendek' => 'string',
        //     'tindakan_jangka_panjang' => 'string',
        //     'berhasil_rencana_backup' => 'string',
        //     'organisasi_lain_dilaporkan' => 'string',
        //     'aset_kritis_terdampak' => 'string',
        //     'dampak_insiden_terhadap_aset' => 'string',
        //     'jumlah_pengguna_terkena_dampak' => 'string',
        //     'dampak_terhadap_ICT' => 'string',
        //     'ip_address_penyerang' => 'ip',
        //     'port_yang_diserang' => 'string',
        //     'tipe_serangan' => 'string',
        //     'laporan_analisis_log' => 'in:ada,tidak ada,sedang proses',
        //     'laporan_forensik' => 'in:ada,tidak ada,sedang proses',
        //     'laporan_audit' => 'in:ada,tidak ada,sedang proses',
        //     'laporan_analisis_network_traffic' => 'in:ada,tidak ada,sedang proses',
        //     'nama_dan_versi_perangkat' => 'string',
        //     'lokasi_perangkat' => 'string',
        //     'sistem_operasi' => 'string',
        //     'terakhir_update_sistem' => 'date',
        //     'ip_address' => 'ip',
        //     'mac_address' => 'string',
        //     'dns_entry' => 'string',
        //     'domain_workgroup' => 'string',
        //     'terhubung_ke_jaringan' => 'string|in:ya,tidak',
        //     'terhubung_ke_modem' => 'string|in:ya,tidak',
        //     'pengamanan_fisik' => 'string|in:ya,tidak',
        //     'pengamanan_logik' => 'string|in:ya,tidak',
        //     'perangkat_diputus' => 'string|in:ya,tidak',
        //     'status_insiden' => 'string',
        //     'pernah_ditawarkan_ke_si_krisis' => 'string',
        //     'ttd_vp_ti' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'ttd_tis' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'ttd_ti_officer' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        $report = Reports::find($id);

        // Create a new incident instance
        $incident = new Incident();

        $incident->id_pelapor = $request->id_pelapor;
        $incident->nama_pelapor = $request->nama_pelapor;
        $incident->email = $request->email;
        $incident->unit = $request->unit;
        $incident->tipe_laporan = $request->tipe_laporan;
        $incident->waktu_insiden = $request->waktu_insiden;
        $incident->tipe = $request->tipe;
        $incident->deskripsi_insiden = $request->deskripsi_insiden;
        $incident->screenshot_insiden = $report->bukti;
        $incident->domainname_insiden = $request->domainname_insiden;
        $incident->url_insiden = $request->url_insiden;
        $incident->email_insiden = $request->email_insiden;
        $incident->dampak_insiden = $request->dampak_insiden;
        $incident->tindakan_penanggulangan_jangka_pendek = $request->tindakan_jangka_pendek;
        $incident->tindakan_penanggulangan_jangka_panjang = $request->tindakan_jangka_panjang;
        $incident->berhasil_rencana_backup_system = $request->berhasil_rencana_backup;
        $incident->organisasi_lain_dilaporkan = $request->organisasi_lain_dilaporkan;
        $incident->aset_kritis_terdampak = $request->aset_kritis_terdampak;
        $incident->dampak_insiden_terhadap_aset = $request->dampak_insiden_terhadap_aset;
        $incident->jumlah_pengguna_terkena_dampak = $request->jumlah_pengguna_terkena_dampak;
        $incident->dampak_terhadap_ICT = $request->dampak_terhadap_ICT;
        $incident->ip_address_penyerang = $request->ip_address_penyerang;
        $incident->port_yang_diserang = $request->port_yang_diserang;
        $incident->tipe_serangan = $request->tipe_serangan;
        $incident->laporan_analisis_log = $request->laporan_analisis_log;
        $incident->laporan_forensik = $request->laporan_forensik;
        $incident->laporan_audit = $request->laporan_audit;
        $incident->laporan_analisis_network_traffic = $request->laporan_analisis_network_traffic;
        $incident->nama_dan_versi_perangkat = $request->nama_dan_versi_perangkat;
        $incident->lokasi_perangkat = $request->lokasi_perangkat;
        $incident->sistem_operasi = $request->sistem_operasi;
        $incident->terakhir_update_sistem = $request->terakhir_update_sistem;
        $incident->ip_address = $request->ip_address;
        $incident->mac_address = $request->mac_address;
        $incident->dns_entry = $request->dns_entry;
        $incident->domain_workgroup = $request->domain_workgroup;
        $incident->perangkat_terhubung_ke_jaringan = $request->terhubung_ke_jaringan;
        $incident->perangkat_terhubung_ke_modem = $request->terhubung_ke_modem;
        $incident->pengamanan_fisik_perangkat = $request->pengamanan_fisik;
        $incident->pengamanan_logik_perangkat = $request->pengamanan_logik;
        $incident->perangkat_diputus = $request->perangkat_diputus;
        $incident->status_insiden = $request->status_insiden;
        $incident->pernah_ditawakan_ke_si_krisis = $request->pernah_ditawarkan_ke_si_krisis;
        // Assuming you have fields for file upload for ttd_vp_ti, ttd_tis, and ttd_ti_officer
        if ($request->hasFile('ttd_vp_ti')) {
            $incident->ttd_vp_ti = $request->file('ttd_vp_ti')->store('images', 'public');
        } else {
            $incident->ttd_vp_ti = '';
        }
        if ($request->hasFile('ttd_tis')) {
            $incident->ttd_tis = $request->file('ttd_tis')->store('images', 'public');
        } else {
            $incident->ttd_tis = '';
        }
        if ($request->hasFile('ttd_ti_officer')) {
            $incident->ttd_ti_officer = $request->file('ttd_ti_officer')->store('images', 'public');
        } else {
            $incident->ttd_ti_officer = '';
        }
        // $incident->ttd_vp_ti = '';
        // $incident->ttd_tis = '';
        // $incident->ttd_ti_officer = '';

        if ($incident->save()) {
            // Redirect the user to a success page with a success message
            return redirect()->route('insiden')->with('success', 'Incident created successfully.');
        } else {
            // Redirect the user back with an error message if saving fails
        }
    }

    public function show($id)
    {
        // Retrieve the incident from the database
        $incident = Incident::findOrFail($id);

        // Pass the incident data to the view
        return view('narahubung.show', compact('incident'));
    }

    public function form_create_by_id($id)
    {
        $reports = Reports::findOrFail($id);
        return view('narahubung.create_insiden_by_id', compact('reports'));
    }
    public function deleteIncident($id)
    {
        $content = Incident::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('insiden')->with('message', 'Insiden berhasil dihapus');
        }

        return redirect()->route('insiden')->with('message', 'Insiden tidak ditemukan');
    }
    

    public function storeSDP(Request $request)
    {
        try {
            $requestData = $request->only([
                'subject',
                'description',
                'requester_id',
                'requester_name',
                'detail_impact',
                'resolution',
                'request_type',
                'technician_name',
                'technician_id',
            ]);

            // Constructing data in the format expected by the API
            $requestDataFormatted = [
                'request' => [
                    'subject' => "csirt_ap1".$requestData['subject'],
                    'description' => $requestData['description'],
                    'requester' => [
                        'id' => $requestData['requester_id'],
                        'name' => $requestData['requester_name'],
                    ],
                    'impact_details' => $requestData['detail_impact'],
                    'resolution' => [
                        'content' => $requestData['resolution'],
                    ],
                    'status' => [
                        'name' => $requestData['request_type'],
                    ],
                ],
            ];

            // Make a POST request to the API
            $response = Http::withToken('1000.df35a3b3b1c3e81026c138fb374044df.18dad7076dc18a436748fde357811345')
                ->withHeaders([
                    'Authorization' => 'Bearer 372E6BC9-C1B3-42B2-A289-33419DFDFE30', // Include the token value here
                    'Content-Type' => 'application/form-data',
                ])
                ->post('https://sdp.ap1.co.id/api/v3/requests?input_data={"request":{"subject":"csirt_ap1test","description":"test","requester":{"id":"4","name":"administrator"},"impact_details":"test","resolution":{"content":"test"},"status":{"name":"Open"}}}');
            echo json_encode($requestDataFormatted);    
            echo $response;
            // // Check if the request was successful
            // if ($response->successful()) {
            //     // Request was successful
            //     return redirect()->route('pelapor.reportPelapor')->with('message', 'Laporan berhasil ditambahkan');
            // } else {
            //     // Request failed
            //     echo json_encode($requestDataFormatted);
            //     echo $response->status();
            //     // return redirect()->route('pelapor.reportPelapor')->with('message', 'Input gagal, Periksa kembali inputan ');
            // }
        } catch (Exception $e) {
            // Request Exception occurred
            // echo json_encode($requestDataFormatted);
            echo $e->getMessage();
        }
    }

}
