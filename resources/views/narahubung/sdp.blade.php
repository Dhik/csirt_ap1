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
                <a href="{{ route('narahubung') }}" class="nav-item nav-link  menu">Data Laporan</a>
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
                    <h2 class="mb-4 text-center">SDP (ServiceDesk Plus)</h2>
                    <div class="table-responsive">
                        @if(isset($errorMessage))
                        <div class="alert alert-danger" role="alert">
                            {{$errorMessage}}
                        </div>
                        @else
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModalSDP('store')">Buat Laporan ke SDP</button>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No Ticket</th>
                                    <th scope="col">Requester Name</th>
                                    <th scope="col">Short Description</th>
                                    <th scope="col">Created Time</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Technician Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $request)
                                <tr>
                                    <td>{{$request['id']}}</td>
                                    <td>{{$request['requester']['name']}}</td>
                                    <td>{!! $request['short_description'] !!}</td>
                                    <td>{{$request['created_time']['display_value']}}</td>
                                    <td>{{$request['subject']}}</td>
                                    <td>{{$request['technician']['name']}}</td>
                                    <td>{{$request['status']['name']}}</td>
                                    <td><button class="btn btn-sm btn-primary ButtonAksi" style="width: 80px;"
                                            onclick="tampilkanModal('update', {{ $request['id'] }})">Lihat</button>
                                        <button class="btn btn-sm btn-success ButtonAksi" style="width: 80px;"
                                            onclick="tampilkanModal('update', {{ $request['id'] }})">Ubah Status</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahKontenModalSDP">
    <div class="modal-dialog" style="max-width: 700px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Request</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('misis.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <input type="hidden" name="formMethod" id="formMethod" value="">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="mb-3">
                        <label for="name">Subject</label>
                        <p class="form-control" id="requester_name" name="requester_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Description</label>
                        <p class="form-control" id="requester_email" name="requester_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">ID Requester</label>
                        <p class="form-control" id="item_name" name="item_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Requester Name</label>
                        <p class="form-control" id="resolved_time" name="resolved_time"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Detail Impact</label>
                        <p class="form-control" id="status_name" name="status_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Resolution</label>
                        <p class="form-control" id="template_name" name="template_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Status</label>
                        <p class="form-control" id="request_type" name="request_type"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Technician Name</label>
                        <p class="form-control" id="responded_time" name="responded_time"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">ID Technician</label>
                        <p class="form-control" id="subject" name="subject"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Tambah Konten -->
<div class="modal fade" id="tambahKontenModal">
    <div class="modal-dialog" style="max-width: 700px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Request</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('misis.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <input type="hidden" name="formMethod" id="formMethod" value="">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="mb-3">
                        <label for="name">Nama Requester</label>
                        <p class="form-control" id="requester_name" name="requester_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Email Requester</label>
                        <p class="form-control" id="requester_email" name="requester_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Item</label>
                        <p class="form-control" id="item_name" name="item_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Resolved Time</label>
                        <p class="form-control" id="resolved_time" name="resolved_time"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Status</label>
                        <p class="form-control" id="status_name" name="status_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Template</label>
                        <p class="form-control" id="template_name" name="template_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Request Type</label>
                        <p class="form-control" id="request_type" name="request_type"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Responded Time</label>
                        <p class="form-control" id="responded_time" name="responded_time"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Subject</label>
                        <p class="form-control" id="subject" name="subject"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Mode</label>
                        <p class="form-control" id="mode" name="mode"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Email to</label>
                        <p class="form-control" id="email_to" name="email_to"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Description</label>
                        <p class="form-control" id="description" name="description"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Nama Teknisi</label>
                        <p class="form-control" id="technician_name" name="technician_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Email Teknisi</label>
                        <p class="form-control" id="technician_email_id" name="technician_email_id"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Departemen Teknisi</label>
                        <p class="form-control" id="technician_dept_name_site" name="technician_dept_name_site"></p>
                        <p class="form-control" id="technician_dept_name" name="technician_dept_name"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name">Kategori</label>
                        <p class="form-control" id="category_name" name="category_name"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
                        <!-- <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button> -->
                    </div>
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
        function tampilkanModalSDP(action, id = null) {
            $('#tambahKontenModalSDP').modal('show');
            $('#editFormSDP')[0].reset();
        }
        function tampilkanModal(action, id = null) {
            $('#tambahKontenModal').modal('show');
            $('#editForm')[0].reset();
            // Set the form method and action based on the provided action
            if (action === 'store') {
                console.log("Not used");
            } else if (action === 'update' && id) {
                $.ajax({
                url: "{{ url('/sdp/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    // Fill the form fields with the existing data
                    $('#id').val(data.id);
                    $('#requester_name').text(data.requester.name);
                    $('#requester_email').text(data.requester.email_id);
                    $('#item_name').text(data.item.name);
                    $('#resolved_time').text(data.resolved_time.display_value);
                    $('#status_name').text(data.status.name);
                    $('#template_name').text(data.template.name);
                    $('#request_type').text(data.request_type.name);
                    $('#responded_time').text(data.responded_time.display_value);
                    $('#subject').text(data.subject);
                    $('#mode').text(data.mode.name);
                    $('#email_to').text(data.email_to);
                    $('#description').html(data.description);
                    $('#technician_name').text(data.technician.name);
                    $('#technician_email_id').text(data.technician.email_id);
                    $('#technician_dept_name_site').text(data.technician.department.site.name);
                    $('#technician_dept_name').text(data.technician.department.name);
                    $('#category_name').text(data.technician.name);
                    // Update the form method to the update route
                    // $('#editForm').attr('action', '{{ route("misis.storeOrUpdate") }}');
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