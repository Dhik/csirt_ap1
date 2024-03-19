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
            <a href="{{ route('narahubung') }}" style="text-decoration: none;color: inherit;">

                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src={{ asset('img/user.png') }} alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
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
                <a href="{{ route('narahubung') }}" class="nav-item nav-link text-center menu">Narahubung</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px;">
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="{{ route('editProfil', ['id' => auth()->user()->id]) }}" class="dropdown-item">Edit Profile</a>
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
                height: 60px; /* You can adjust the height value as needed */
            }
        </style>
        <div class="container-fluid pt-4 px-4">
            <div class="col-10 tableContent g-4">
                <div class="bg-light rounded h-100 p-4">
                    <h2 class="mb-4 text-center">Data Laporan</h2>
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Input Insiden</button>
                            <button type="button" class="btn btn-primary ms-2 addButton" >Download PDF</button>
                        </div>
                        <table class="table align-middle text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">SATKER</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Insiden Type</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Penanganan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Bukti</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $report->satker }}</td>
                                    <td>{{ $report->user->nama_user }}</td>
                                    <td>{{ $report->tanggal }}</td>
                                    <td>{{ $report->insiden_type }}</td>
                                    <td>{{ $report->keterangan }}</td>
                                    <td>{{ $report->penanganan }}</td>
                                    <td>{{ $report->status }}</td>
                                    <td>
                                        @if($report->bukti)
                                            <img src="{{ Storage::url('/' . $report->bukti) }}" alt="Bukti" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $report->id  }})">Edit</button>

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
                <form id="editForm" method="post" enctype="multipart/form-data" action="{{ route('pelapor.storeOrUpdate') }}">
                    @csrf
                    <input type="hidden" id="formMethod" name="formMethod" value="">
                    <input type="hidden" name="report_id" id="editReportId" value="">
                    <input type="text" name="user_id" id="user_id" value="{{ $auth->id }}" hidden>
                    <div class="mb-3">
                        <label for="satker">Nama </label>
                        <input class="form-control" type="text" name="satker" id="satker" readonly value="{{ $auth->role_user }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_user">Email</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="nama_user">No Telpon Organisasi </label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="nama_user"> No Handphone </label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="insiden_type">Tipe Laporan</label>
                        <select class="form-control" id="insiden_type" name="insiden_type" >
                            <option value="Malware">Awal</option>
                            <option value="DDoS">Tindak Lanjut</option>
                            <option value="Phishing">Akhir</option>
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" >
                    </div><div class="mb-3">
                        <label for="waktu">Waktu</label>
                        <input class="form-control" type="time" name="waktu" id="waktu">
                    </div>
                    
                    <div class="mb-3">
                        <label>Insiden Type</label>
                        <div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Web Defacement</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Account Compromise</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Patched Software Exploitation</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Service Distrupsion</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Exploitation Of Weak Configuration</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="malware" name="insiden_type[]" value="Malware">
                                <label class="form-check-label" for="malware">Social Engineering And Phising Attack</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ddos" name="insiden_type[]" value="DDoS">
                                <label class="form-check-label" for="ddos">Unintentional Information Exposure</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="phishing" name="insiden_type[]" value="Phishing">
                                <label class="form-check-label" for="phishing">Spoofing or DNS Poisioning</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sql_injection" name="insiden_type[]" value="SQL Injection">
                                <label class="form-check-label" for="sql_injection">Un-patched Vulnarable Software Exploitation</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]" value="Other">
                                <label class="form-check-label" for="other">Unauthorised System Acces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]" value="Other">
                                <label class="form-check-label" for="other">Data Theft</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]" value="Other">
                                <label class="form-check-label" for="other">Malware Infection</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]" value="Other">
                                <label class="form-check-label" for="other">Wireless Acces Point Exploitation</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]" value="Other">
                                <label class="form-check-label" for="other">Network Penetration</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="other" name="insiden_type[]" value="Other">
                                <label class="form-check-label" for="other">Others</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="keterangan">Deskripsi Insiden</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bukti">Bukti</label>
                        <input type="file" class="form-control" id="bukti" name="bukti">
                    </div>
                    
                    <div class="mb-3">
                        <label>Dampak Insiden</label>
                        <div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Jaringan Publik</label>
                            </div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Jaringan Internal</label>
                            </div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Lainnya</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="respon_pendek">Respon Jangka Pendek</label>
                        <textarea class="form-control" id="respon_pendek" name="respon_pendek" rows="4" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="respon_panjang">Respon Jangka Panjang</label>
                        <textarea class="form-control" id="respon_panjang" name="respon_panjang" rows="4" ></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Apakah Perencanaan Backup System Berhasil?</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Deskripsikan proses tersebut</label>
                        <textarea class="form-control" id="deskripsi_backup" name="deskripsi_backup" rows="4" ></textarea>
                    </div>

                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Apakah Organisasi Lain dilaporkan?</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>

                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Aset Kritis yang Terkena Dampak</label>
                        <textarea class="form-control" id="deskripsi_backup" name="deskripsi_backup" rows="4" ></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Dampak Insiden Terhadap Aset</label>
                        <div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Data Theft</label>
                            </div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">System Sabotase</label>
                            </div>                              
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Service Distruption</label>
                            </div>                         
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Lainnya</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Jumlah Pengguna yang Terkena Dampak</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>

                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Dampak Terhadap ICT</label>
                        <textarea class="form-control" id="deskripsi_backup" name="deskripsi_backup" rows="4" ></textarea>
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">IP Address Penyerang</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
                    
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Port yang diserang</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>

                    <div class="mb-3">
                        <label>Tipe Serangan</label>
                        <div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Website Defacement</label>
                            </div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Account Compromise</label>
                            </div>      
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sql_injection" name="insiden_type[]" value="SQL Injection">
                                <label class="form-check-label" for="sql_injection">Un-patched Vulnarable Software Exploitation</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sql_injection" name="insiden_type[]" value="SQL Injection">
                                <label class="form-check-label" for="sql_injection">Patched Software Exploitation</label>
                            </div>                    
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sql_injection" name="insiden_type[]" value="SQL Injection">
                                <label class="form-check-label" for="sql_injection">Unauthorised System Acces</label>
                            </div>   
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sql_injection" name="insiden_type[]" value="SQL Injection">
                                <label class="form-check-label" for="sql_injection">Data Theft</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="web_defacement" name="insiden_type[]" value="Web Defacement">
                                <label class="form-check-label" for="web_defacement">Lainnya</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Laporan Analisis Log</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ada</option>
                            <option value="Tidak">Tidak Ada</option>
                            <option value="Tidak">Sedang Proses</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Laporan Forensic</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ada</option>
                            <option value="Tidak">Tidak Ada</option>
                            <option value="Tidak">Sedang Proses</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Laporan Audit</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ada</option>
                            <option value="Tidak">Tidak Ada</option>
                            <option value="Tidak">Sedang Proses</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Laporan Analisis Lalu Lintas Jaringan</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ada</option>
                            <option value="Tidak">Tidak Ada</option>
                            <option value="Tidak">Sedang Proses</option>
                        </select>
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Nama dan Versi Perangkat</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Lokasi Perangkat</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Sistem Operasi</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Terakhir Update Sistem</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">IP Address </label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">DNS Entry</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">MAC Address</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Domain/Workgroup</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Apakah Perangkat yang Terkena Terhubung Kejaringan ?</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Apakah Perangkat yang Terkena Terhubung Kemodem ?</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Adakah Pengamanan Fisik Terhadap Perangkat ?</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Adakah Pengamanan Logik Terhadap Perangkat ?</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Apakah Perangkat Sudah Diputus dari Jaringan ?</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
            
                    <div class="mb-3" id="deskripsi_backup_system">
                        <label for="deskripsi_backup">Status Insiden</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="Pending">Pending</option>
                            <option value="Pending">In Progress</option>
                            <option value="Pending">Done</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="backup_system">Apakah Sudah Pernah Ditawarkan Sistem Manajemen Krisis ?</label>
                        <select class="form-control" id="backup_system" name="backup_system">
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
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