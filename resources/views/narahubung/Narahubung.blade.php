<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Narahubung')</title>
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

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
            <div class="col-10 tableContent g-4">
                <div class="bg-light rounded h-100 p-4">
                    <h2 class="mb-4 text-center">Data Laporan</h2>
                    <div class="table-responsive">
                        <!-- <div class="d-flex justify-content-between">
                            <a href="{{ route('insiden.create') }}" class="btn btn-success ms-2 addButton">Input
                                insiden</a>
                        </div> -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Insiden Type</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Penanganan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Bukti</th>
                                    <th scope="col">Aksi</th>
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
                                    @if ($report->penanganan != '-')
                                    <td style="color:#87A922; ">{{ $report->penanganan }}</td>
                                    @else
                                    <td>{{ $report->penanganan }}</td>
                                    @endif
                                    <td>{{ $report->status }}</td>
                                    <td>
                                        @if($report->bukti)
                                        <img src="{{ Storage::url('/' . $report->bukti) }}" alt="Bukti" style="max-width: 100px; max-height: 100px;">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('insiden.create_by_id', $report->id) }}" class="btn btn-sm btn-primary ButtonAksi" style="width: 90px;">Tambah Laporan Detail</a>
                                            <button class="btn btn-sm btn-success ButtonAksi" style="width: 90px;"
                                            onclick="tampilkanModal('update', {{ $report->id }})">Respon Penanganan</button>
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
                <h5 class="modal-title">Update Laporan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('report.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="user_id" id="user_id" value="{{ $auth->id }}" hidden>
                    <input type="hidden" name="report_id" id="report_id" value="">
                    
                    <div class="mb-3">
                        <label for="satker">Unit</label>
                        <input class="form-control" type="text" name="satker" id="satker" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_user">Nama User</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="insiden_type">Insiden Type</label>
                        <select class="form-control" id="insiden_type" name="insiden_type" required>
                            <option value="Malware">Malware</option>
                            <option value="DDoS">Serangan DDoS</option>
                            <option value="Phishing">Serangan Phishing</option>
                            <option value="SQL Injection">Serangan SQL Injection</option>
                            <option value="Web Defacement">Web Defacement</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="penanganan">Penanganan</label>
                        <textarea class="form-control" id="penanganan" name="penanganan" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Open">Open</option>
                            <option value="Resolve">Resolve</option>
                            <option value="Action">Action</option>
                            <option value="In Progress">In Progress</option>
                            <option value="On Hold">On Hold</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="tutupModal()">Tutup</button>
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
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('/js/main.js') }}"></script>
    <script>
        function tampilkanModal(action, id = null) {
            $('#tambahKontenModal').modal('show');
            if (action === 'update' && id) {
            // Use AJAX to fetch the existing data for the gallery
                $.ajax({
                    url: "{{ url('/report/show/') }}" + '/' + id,
                    type: 'GET',
                    success: function (data) {
                        // Fill the form fields with the existing data
                        $('#report_id').val(data.id);
                        $('#satker').val(data.satker);
                        $('#nama_user').val(data.nama_user);
                        $('#tanggal').val(data.tanggal);
                        $('#insiden_type').val(data.insiden_type);
                        $('#keterangan').val(data.keterangan);
                        $('#penanganan').val(data.penanganan);
                        
                        // Update the form method to the update route
                        $('#editForm').attr('action', '{{ route("strukturs.storeOrUpdate") }}');
                        // Update the form method to 'update'
                        $('#formMethod').val('update');
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        }
        function tutupModal() {
        $('#tambahKontenModal').modal('hide');
    }
    </script>
</body>

</html>