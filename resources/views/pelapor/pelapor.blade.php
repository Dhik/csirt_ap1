@extends('layout.pelaporLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data Report</h2>
            <div class="table-responsive">
                
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Input Insiden</button>
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModalSDP('store')">Input Request ke SDP</button>
                </div>
                @if(isset($errorMessage))
                        <div class="alert alert-danger" role="alert">
                            {{$errorMessage}}
                        </div>
                        @else
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
                                @if($report->status == 'Open')
                                    <button class="btn btn-sm btn-primary ButtonAksi" style="width: 80px;" onclick="tampilkanModal('update', {{ $report->id  }})">Edit</button>
                                    <form action="{{ route('pelapor.delete', ['id' => $report->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" style="width: 80px;" class="btn btn-sm btn-danger ButtonAksi">Hapus</button>
                                    </form>
                                @endif
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

<div class="modal fade" id="tambahKontenModalSDP">
    <div class="modal-dialog" style="max-width: 700px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Request</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('sdp.store') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <input type="hidden" name="formMethod" id="formMethod" value="">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="mb-3">
                        <label for="name">Subject</label>
                        <input class="form-control" id="subject" name="subject">
                    </div>
                    <div class="mb-3">
                        <label for="name">Description</label>
                        <input class="form-control" id="description" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="name">ID Requester</label>
                        <input class="form-control" id="requester_id" name="requester_id">
                    </div>
                    <div class="mb-3">
                        <label for="name">Requester Name</label>
                        <input class="form-control" id="requester_name" name="requester_name">
                    </div>
                    <div class="mb-3">
                        <label for="name">Detail Impact</label>
                        <input class="form-control" id="detail_impact" name="detail_impact">
                    </div>
                    <div class="mb-3">
                        <label for="name">Resolution</label>
                        <input class="form-control" id="resolution" name="resolution">
                    </div>
                    <div class="mb-3">
                        <label for="name">Status</label>
                        <select class="form-control" id="request_type" name="request_type" required>
                            <option value="Open">Open</option>
                            <option value="Resolve">Resolve</option>
                            <option value="Action">Action</option>
                            <option value="In Progress">In Progress</option>
                            <option value="On Hold">On Hold</option>
                            <option value="Customer Actions">Customer Actions</option>
                            <option value="Closed">Closed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModalSDP()">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </div>
                </form>
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
                        <label for="satker">Unit</label>
                        <input class="form-control" type="text" name="satker" id="satker" value="{{ $auth->role_user }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_user">Nama User</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" value="{{ $auth->nama_user }}">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" >
                    </div>
                    <div class="mb-3">
                        <label for="insiden_type">Insiden Type</label>
                        <select class="form-control" id="insiden_type" name="insiden_type" >
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
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" ></textarea>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="penanganan">Penanganan</label>
                        <textarea class="form-control" id="penanganan" name="penanganan" rows="4" value="-"></textarea>
                    </div> -->
                    <!-- <div class="mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="Open">Open</option>
                        </select>
                    </div> -->
                    <div class="mb-3">
                        <label for="bukti">Bukti</label>
                        <input type="file" class="form-control" id="bukti" name="bukti">
                    </div>
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function tampilkanModalSDP(action, id = null) {
            $('#tambahKontenModalSDP').modal('show');
            $('#editFormSDP')[0].reset();
    }
    function tampilkanModal(action, id = null) {
        $('#tambahKontenModal').modal('show');
        // Clear the form fields when showing the modal for adding or editing
        $('#editForm')[0].reset();

        // Set the form method and action based on the provided action
        if (action === 'store') {
            $('#editForm').attr('method', 'post');
            $('#editForm').attr('action', '{{ route("pelapor.storeOrUpdate") }}');
            $('#formMethod').val('store');  // Set the value to 'store'
        } else if (action === 'update' && id) {
            // Use AJAX to fetch the existing data for the report
            $.ajax({
                url: "{{ url('/pelapor/show/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    $('#editReportId').val(data.id);
                    $('#tanggal').val(data.tanggal);
                    $('#insiden_type').val(data.insiden_type);
                    $('#keterangan').val(data.keterangan);
                    $('#penanganan').val(data.penanganan);
                    $('#status').val(data.status);

                    
                    $('#editForm').attr('method', 'post');
                    $('#editForm').attr('action', '{{ route("pelapor.storeOrUpdate") }}');
                    // Update the form method to 'update'
                    $('#formMethod').val('update');  // Set the value to 'update'

                    // Add an event listener for the file input to display the selected file name
                    $('#bukti').on('change', function() {
                        var fileName = $(this).val().split('\\').pop();
                        $(this).next('.custom-file-label').html(fileName);
                    });

                    // Display the selected file name if a file is already attached
                    var fileName = $('#bukti').val().split('\\').pop();
                    $('#bukti').next('.custom-file-label').html(fileName);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    }
    document.getElementById('editForm').addEventListener('submit', function (event) {
        var tanggal = document.getElementById('tanggal').value;
        var insiden_type = document.getElementById('insiden_type').value;
        var keterangan = document.getElementById('keterangan').value;
        var status = document.getElementById('status').value;


        if (!tanggal || !insiden_type || !keterangan || !status) {
            alert('Harap isi semua kolom yang wajib diisi.');
            event.preventDefault();
        }
    });
    function tutupModal() {
        // Use direct dismissal without relying on a click event
        $('#tambahKontenModal').modal('hide');
    }
    var msg = '{{Session::get('message')}}';
    var exist = '{{Session::has('message')}}';
    if(exist){
        alert(msg);
    }
</script>

@endpush

@section('title','Pelapor | Report Managemen')

