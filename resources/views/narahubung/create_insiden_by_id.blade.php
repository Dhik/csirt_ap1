<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Narahubung')</title>
    <!-- Favicon -->
    <link href={{ asset('img/favicon.ico') }} rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/pimpinan.css') }}" rel="stylesheet">

    {{-- css global ours --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3 styleNav">
        <nav class="navbar bg-light navbar-light">
            <a href="index.html" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">PT Angkasa Pura I</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <img src="{{ asset('/img/logoHub.svg') }}" class="navImg" alt="logo">
            </div>
            <a href="{{ route('narahubung') }}" style="text-decoration: none;color: inherit;">

                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src={{ asset('img/user.png') }} alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        @auth
                        <h6 class="mb-0">{{ auth()->user()->nama_user }}</h6>
                        <span>{{ auth()->user()->role_user }}</span>
                        @else
                        <p>No user logged in</p>
                        @endauth
                    </div>
                </div>
            </a>

            <div class="navbar-nav w-100">
                <a href="{{ route('narahubung') }}" class="nav-item nav-link menu">Data Laporan</a>
            </div>
            <div class="navbar-nav w-100">
                <a href="{{ route('sdp') }}" class="nav-item nav-link menu">SDP (ServiceDesk
                    Plus)</a>
            </div>
            <div class="navbar-nav w-100">
                <a href="{{ route('insiden') }}" class="nav-item nav-link menu">Detail Insiden</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        <h2 class="navbar-brand mb-0 mx-4"><span style="font-weight: normal !important;">Content Management System CSIRT /</span> Narahubung</h2>
        <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px;">
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="{{ route('editProfil', ['id' => auth()->user()->id]) }}" class="dropdown-item">Edit
                        Profile</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Log Out</button>
                    </form>
                </div>
            </div>

        </div>
    </nav>
    <!-- Navbar End -->
    </div>

    {{--content--}}

    <div class="content" style="background: white; padding: 50px;">
        <style>
            /* Custom CSS to set the height of td elements */
            table td {
                height: 60px;
                /* You can adjust the height value as needed */
            }
        </style>
        <div class="container-fluid pt-4 px-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Create Incident</h1>
                        <form action="{{ route('insiden.store_by_id', ['id' => $reports->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="id_pelapor">ID Laporan</label>
                                <input type="text" class="form-control" id="id_pelapor" value="{{ $reports->user_id }}" name="id_pelapor">
                            </div>
                            <div class="form-group">
                                <label for="nama_pelapor">Nama Pelapor</label>
                                <input type="text" class="form-control" id="nama_pelapor" value="{{ $reports->nama_user }}" name="nama_pelapor">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="text" class="form-control" id="unit" name="unit" value="{{ $reports->satker }}">
                            </div>
                            <div class="form-group">
                                <label for="tipe_laporan">Tipe Laporan</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_laporan" id="tipe_laporan_awal" value="awal">
                                        <label class="form-check-label" for="tipe_laporan_awal">Awal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_laporan" id="tipe_laporan_tindak_lanjut" value="tindak_lanjut">
                                        <label class="form-check-label" for="tipe_laporan_tindak_lanjut">Tindak
                                            Lanjut</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_laporan" id="tipe_laporan_akhir" value="akhir">
                                        <label class="form-check-label" for="tipe_laporan_akhir">Akhir</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_insiden">Waktu Insiden</label>
                                <input type="date" class="form-control" id="waktu_insiden" name="waktu_insiden" value="{{ $reports->tanggal }}">
                            </div>
                            <div class="form-group">
                                <label for="tipe">Tipe</label>
                                <input type="text" class="form-control" id="tipe" name="tipe" value="{{ $reports->insiden_type }}">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_insiden">Deskripsi Insiden</label>
                                <textarea class="form-control" id="deskripsi_insiden" name="deskripsi_insiden" rows="4" value="{{ $reports->keterangan }}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="screenshot_insiden">Screenshot Insiden</label>
                                <input type="text" class="form-control" readonly id="screenshot_insiden" name="screenshot_insiden" value="{{ $reports->bukti }}">
                                @if($reports->bukti)
                                <img src="{{ asset('storage/' . $reports->bukti) }}" alt="Bukti" style="max-width: 200px; max-height: 200px;">
                                @else
                                <p>No Image</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="domainname_insiden">Domainname Insiden</label>
                                <input type="text" class="form-control" id="domainname_insiden" name="domainname_insiden">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="url_insiden">URL Insiden</label>
                                    <input type="text" class="form-control" id="url_insiden" name="url_insiden">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email_insiden">Email Insiden</label>
                                    <input type="email" class="form-control" id="email_insiden" name="email_insiden">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dampak_insiden">Dampak Insiden</label>
                                <select class="form-control" id="dampak_insiden" name="dampak_insiden">
                                    <option value="jaringan publik">Jaringan Publik</option>
                                    <option value="jaringan internal">Jaringan Internal</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="tindakan_jangka_pendek">Tindakan Penanggulangan Jangka Pendek</label>
                                    <textarea class="form-control" id="tindakan_jangka_pendek" name="tindakan_jangka_pendek" rows="4"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tindakan_jangka_panjang">Tindakan Penanggulangan Jangka Panjang</label>
                                    <textarea class="form-control" id="tindakan_jangka_panjang" name="tindakan_jangka_panjang" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="berhasil_rencana_backup">Apakah Berhasil Rencana Backup System</label>
                                <input type="text" class="form-control" id="berhasil_rencana_backup" name="berhasil_rencana_backup">
                            </div>
                            <div class="form-group">
                                <label for="organisasi_lain_dilaporkan">Apakah Organisasi Lain Dilaporkan</label>
                                <input type="text" class="form-control" id="organisasi_lain_dilaporkan" name="organisasi_lain_dilaporkan">
                            </div>
                            <div class="form-group">
                                <label for="aset_kritis_terdampak">Aset Kritis yang Terdampak</label>
                                <textarea class="form-control" id="aset_kritis_terdampak" name="aset_kritis_terdampak" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="dampak_aset">Dampak Insiden Terhadap Aset</label>
                                <select class="form-control" id="dampak_aset" name="dampak_aset">
                                    <option value="data theft">Data Theft</option>
                                    <option value="system sabotage">System Sabotage</option>
                                    <option value="service disruption">Service Disruption</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_pengguna_terkena_dampak">Jumlah Pengguna yang Terkena Dampak</label>
                                <input type="text" class="form-control" id="jumlah_pengguna_terkena_dampak" name="jumlah_pengguna_terkena_dampak">
                            </div>
                            <div class="form-group">
                                <label for="dampak_terhadap_ICT">Dampak Terhadap ICT</label>
                                <input type="text" class="form-control" id="dampak_terhadap_ICT" name="dampak_terhadap_ICT">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ip_address_penyerang">IP Address Penyerang</label>
                                    <input type="text" class="form-control" id="ip_address_penyerang" name="ip_address_penyerang">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="port_yang_diserang">Port yang Diserang</label>
                                    <input type="text" class="form-control" id="port_yang_diserang" name="port_yang_diserang">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tipe_serangan">Tipe Serangan</label>
                                <select class="form-control" id="tipe_serangan" name="tipe_serangan">
                                    <option value="website defacement">Website Defacement</option>
                                    <option value="account compromise">Account Compromise</option>
                                    <option value="pathed software exploitation">Pathed Software Exploitation</option>
                                    <option value="un-patched vulnerable soft expl">Un-patched Vulnerable Soft
                                        Exploitation</option>
                                    <option value="unauthor system access">Unauthor System Access</option>
                                    <option value="data theft">Data Theft</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Laporan Analisis Log</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_analisis_log" id="laporan_analisis_log_ada" value="ada">
                                    <label class="form-check-label" for="laporan_analisis_log_ada">Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_analisis_log" id="laporan_analisis_log_tidak_ada" value="tidak ada">
                                    <label class="form-check-label" for="laporan_analisis_log_tidak_ada">Tidak
                                        Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_analisis_log" id="laporan_analisis_log_sedang_proses" value="sedang proses">
                                    <label class="form-check-label" for="laporan_analisis_log_sedang_proses">Sedang
                                        Proses</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Laporan Forensik</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_forensik" id="laporan_forensik_ada" value="ada">
                                    <label class="form-check-label" for="laporan_forensik_ada">Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_forensik" id="laporan_forensik_tidak_ada" value="tidak ada">
                                    <label class="form-check-label" for="laporan_forensik_tidak_ada">Tidak Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_forensik" id="laporan_forensik_sedang_proses" value="sedang proses">
                                    <label class="form-check-label" for="laporan_forensik_sedang_proses">Sedang
                                        Proses</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Laporan Audit</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_audit" id="laporan_audit_ada" value="ada">
                                    <label class="form-check-label" for="laporan_audit_ada">Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_audit" id="laporan_audit_tidak_ada" value="tidak ada">
                                    <label class="form-check-label" for="laporan_audit_tidak_ada">Tidak Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_audit" id="laporan_audit_sedang_proses" value="sedang proses">
                                    <label class="form-check-label" for="laporan_audit_sedang_proses">Sedang
                                        Proses</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Laporan Analisis Network Traffic</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_analisis_network_traffic" id="laporan_analisis_network_traffic_ada" value="ada">
                                    <label class="form-check-label" for="laporan_analisis_network_traffic_ada">Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_analisis_network_traffic" id="laporan_analisis_network_traffic_tidak_ada" value="tidak ada">
                                    <label class="form-check-label" for="laporan_analisis_network_traffic_tidak_ada">Tidak Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="laporan_analisis_network_traffic" id="laporan_analisis_network_traffic_sedang_proses" value="sedang proses">
                                    <label class="form-check-label" for="laporan_analisis_network_traffic_sedang_proses">Sedang Proses</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nama_dan_versi_perangkat">Nama dan Versi Perangkat</label>
                                    <input type="text" class="form-control" id="nama_dan_versi_perangkat" name="nama_dan_versi_perangkat">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lokasi_perangkat">Lokasi Perangkat</label>
                                    <input type="text" class="form-control" id="lokasi_perangkat" name="lokasi_perangkat">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="sistem_operasi">Sistem Operasi</label>
                                    <input type="text" class="form-control" id="sistem_operasi" name="sistem_operasi">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="terakhir_update_sistem">Terakhir Update Sistem</label>
                                    <input type="text" class="form-control" id="terakhir_update_sistem" name="terakhir_update_sistem">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ip_address">IP Address</label>
                                    <input type="text" class="form-control" id="ip_address" name="ip_address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mac_address">MAC Address</label>
                                    <input type="text" class="form-control" id="mac_address" name="mac_address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dns_entry">DNS Entry</label>
                                <input type="text" class="form-control" id="dns_entry" name="dns_entry">
                            </div>
                            <div class="form-group">
                                <label for="domain_workgroup">Domain-Workgroup</label>
                                <input type="text" class="form-control" id="domain_workgroup" name="domain_workgroup">
                            </div>
                            <div class="form-group">
                                <label>Apakah Perangkat yang terdampak terhubung ke jaringan</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="terhubung_ke_jaringan" id="terhubung_ke_jaringan_ya" value="ya">
                                    <label class="form-check-label" for="terhubung_ke_jaringan_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="terhubung_ke_jaringan" id="terhubung_ke_jaringan_tidak" value="tidak">
                                    <label class="form-check-label" for="terhubung_ke_jaringan_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Apakah Perangkat Terhubung ke Modem</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="terhubung_ke_modem" id="terhubung_ke_modem_ya" value="ya">
                                    <label class="form-check-label" for="terhubung_ke_modem_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="terhubung_ke_modem" id="terhubung_ke_modem_tidak" value="tidak">
                                    <label class="form-check-label" for="terhubung_ke_modem_tidak">Tidak</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Adakah Pengamanan Fisik Perangkat</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pengamanan_fisik" id="pengamanan_fisik_ya" value="ya">
                                    <label class="form-check-label" for="pengamanan_fisik_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pengamanan_fisik" id="pengamanan_fisik_tidak" value="tidak">
                                    <label class="form-check-label" for="pengamanan_fisik_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Adakah Pengamanan Logik Perangkat</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pengamanan_logik" id="pengamanan_logik_ya" value="ya">
                                    <label class="form-check-label" for="pengamanan_logik_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pengamanan_logik" id="pengamanan_logik_tidak" value="tidak">
                                    <label class="form-check-label" for="pengamanan_logik_tidak">Tidak</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Apakah Perangkat Sudah Diputus</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="perangkat_diputus" id="perangkat_diputus_ya" value="ya">
                                    <label class="form-check-label" for="perangkat_diputus_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="perangkat_diputus" id="perangkat_diputus_tidak" value="tidak">
                                    <label class="form-check-label" for="perangkat_diputus_tidak">Tidak</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status_insiden">Status Insiden</label>
                                <input type="text" class="form-control" id="status_insiden" name="status_insiden" value="{{ $reports->status}}">
                            </div>
                            <div class="form-group">
                                <label for="ditawarkan_ke_si_krisis">Apakah Pernah Ditawarkan ke Si Krisis</label>
                                <select class="form-control" id="ditawarkan_ke_si_krisis" name="ditawarkan_ke_si_krisis">
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="ttd_vp_ti">TTD VP TI</label>
                                    <input type="file" class="form-control-file" id="ttd_vp_ti" name="ttd_vp_ti">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ttd_tis">TTD TIS</label>
                                    <input type="file" class="form-control-file" id="ttd_tis" name="ttd_tis">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ttd_ti_officer">TTD TI Officer</label>
                                    <input type="file" class="form-control-file" id="ttd_ti_officer" name="ttd_ti_officer">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('scripts')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src={{ asset('lib/chart/chart.min.js') }}></script>
    <script src={{ asset('lib/easing/easing.min.js') }}></script>
    <script src={{ asset('lib/waypoints/waypoints.min.js') }}></script>
    <script src={{ asset('lib/owlcarousel/owl.carousel.min.js') }}></script>
    <script src={{ asset('lib/tempusdominus/js/moment.min.js') }}></script>
    <script src={{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}></script>
    <script src={{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}></script>

    <!-- Template Javascript -->
    <script src={{ asset('/js/main.js') }}></script>
    <script>
        function tampilkanModal(action, id = null) {
            $('#tambahKontenModal').modal('show');

        }
    </script>
</body>

</html>