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
    <link href={{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }} rel="stylesheet">
    <link href={{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }} rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href={{ asset('css/style.css') }} rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href={{ asset('css/pimpinan.css') }} rel="stylesheet">

    {{-- css global ours --}}
    <link rel="stylesheet" href={{ asset('css/admin.css') }}>
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
                        <img class="rounded-circle" src={{ asset('img/user.png') }} alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
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
                    <img class="rounded-circle me-lg-2" src="{{ asset('img/user.png') }}" alt=""
                        style="width: 40px; height: 40px;">
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
            <div class="col-10 tableContent g-4">
                <div class="bg-light rounded h-100 p-4">
                    <h2 class="mb-4 text-center">Daftar Insiden</h2>
                    <p class="mb-4 text-center">Berdasarkan Laporan yang dilengkapkan oleh Teknisi</p>
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between">
                            <!-- <button type="button" class="btn btn-success ms-2 addButton"
                                onclick="tampilkanModal('store')">Input Insiden</button> -->
                            <a href="{{ route('insiden.create') }}" class="btn btn-success ms-2 addButton">Input
                                insiden</a>
                        </div>
                        <table class="table align-middle text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pelapor</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Status Insiden</th>
                                    <th scope="col">Screenshot Insiden</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($incidents as $incident)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $incident->nama_pelapor }}</td>
                                    <td>{{ $incident->unit }}</td>
                                    <td>{{ $incident->status_insiden }}</td>
                                    <!-- <td>{{ $incident->screenshot_insiden }}</td> -->
                                    <td>
                                        @if($incident->screenshot_insiden)
                                        <img src="{{ asset('storage/' . $incident->screenshot_insiden) }}" alt="Bukti"
                                            style="max-width: 100px; max-height: 100px;">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('insiden.show', $incident->id) }}"
                                            class="btn btn-sm btn-primary ButtonAksi">Lihat</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('insiden.delete', ['id' => $incident->id]) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this incident?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="width: 60px;" class="btn btn-sm btn-danger ButtonAksi"><p>Hapus</p></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Konten -->
    <div class="modal fade" id="tambahKontenModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Konten</h5>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" enctype="multipart/form-data"
                        action="{{ route('pelapor.storeOrUpdate') }}">
                        @csrf
                        <input type="hidden" id="formMethod" name="formMethod" value="">
                        <input type="hidden" name="report_id" id="editReportId" value="">
                        <input type="text" name="user_id" id="user_id" value="{{ $auth->id }}" hidden>
                        <div class="mb-3">
                            <label for="satker">Nama </label>
                            <input class="form-control" type="text" name="satker" id="satker" readonly
                                value="{{ $auth->role_user }}">
                        </div>
                        <div class="mb-3">
                            <label for="nama_user">Email</label>
                            <input class="form-control" type="text" name="nama_user" id="nama_user" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_user">No Telpon Organisasi </label>
                            <input class="form-control" type="text" name="nama_user" id="nama_user" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_user"> No Handphone </label>
                            <input class="form-control" type="text" name="nama_user" id="nama_user" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="insiden_type">Tipe Laporan</label>
                            <select class="form-control" id="insiden_type" name="insiden_type">
                                <option value="Malware">Awal</option>
                                <option value="DDoS">Tindak Lanjut</option>
                                <option value="Phishing">Akhir</option>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="waktu">Waktu</label>
                            <input class="form-control" type="time" name="waktu" id="waktu">
                        </div>

                        <div class="mb-3">
                            <label>Insiden Type</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="web_defacement"
                                        name="insiden_type[]" value="Web Defacement">
                                    <label class="form-check-label" for="web_defacement">Web Defacement</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="web_defacement"
                                        name="insiden_type[]" value="Web Defacement">
                                    <label class="form-check-label" for="web_defacement">Account Compromise</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="web_defacement"
                                        name="insiden_type[]" value="Web Defacement">
                                    <label class="form-check-label" for="web_defacement">Patched Software
                                        Exploitation</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="web_defacement"
                                        name="insiden_type[]" value="Web Defacement">
                                    <label class="form-check-label" for="web_defacement">Service Distrupsion</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="web_defacement"
                                        name="insiden_type[]" value="Web Defacement">
                                    <label class="form-check-label" for="web_defacement">Exploitation Of Weak
                                        Configuration</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="malware" name="insiden_type[]"
                                        value="Malware">
                                    <label class="form-check-label" for="malware">Social Engineering And Phising
                                        Attack</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ddos" name="insiden_type[]"
                                        value="DDoS">
                                    <label class="form-check-label" for="ddos">Unintentional Information
                                        Exposure</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="phishing" name="insiden_type[]"
                                        value="Phishing">
                                    <label class="form-check-label" for="phishing">Spoofing or DNS Poisioning</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sql_injection"
                                        name="insiden_type[]" value="SQL Injection">
                                    <label class="form-check-label" for="sql_injection">Un-patched Vulnarable Software
                                        Exploitation</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]"
                                        value="Other">
                                    <label class="form-check-label" for="other">Unauthorised System Acces</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]"
                                        value="Other">
                                    <label class="form-check-label" for="other">Data Theft</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]"
                                        value="Other">
                                    <label class="form-check-label" for="other">Malware Infection</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]"
                                        value="Other">
                                    <label class="form-check-label" for="other">Wireless Acces Point
                                        Exploitation</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]"
                                        value="Other">
                                    <label class="form-check-label" for="other">Network Penetration</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]"
                                        value="Other">
                                    <label class="form-check-label" for="other">Others</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan">Deskripsi Insiden</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="bukti">Bukti</label>
                            <input type="file" class="form-control" id="bukti" name="bukti">
                        </div>

                        <div class="mb-3">
                            <label>Dampak Insiden</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="web_defacement"
                                        name="insiden_type[]" value="Web Defacement">
                                    <label class="form-check-label" for="web_defacement">Jaringan Publik</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="web_defacement"
                                        name="insiden_type[]" value="Web Defacement">
                                    <label class="form-check-label" for="web_defacement">Jaringan Internal</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="web_defacement"
                                        name="insiden_type[]" value="Web Defacement">
                                    <label class="form-check-label" for="web_defacement">Lainnya</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="respon_pendek">Respon Jangka Pendek</label>
                            <textarea class="form-control" id="respon_pendek" name="respon_pendek" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="respon_panjang">Respon Jangka Panjang</label>
                            <textarea class="form-control" id="respon_panjang" name="respon_panjang"
                                rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="backup_system">Apakah Perencanaan Backup System Berhasil?</label>
                            <select class="form-control" id="backup_system" name="backup_system">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>

                        <div class="mb-3" id="deskripsi_backup_system" style="display: none;">
                            <label for="deskripsi_backup">Deskripsikan proses tersebut</label>
                            <textarea class="form-control" id="deskripsi_backup" name="deskripsi_backup"
                                rows="4"></textarea>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton"
                            onclick="tutupModal()">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
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