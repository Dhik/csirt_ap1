@extends('layout.pelaporLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data Report</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Input Insiden</button>
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Satker</th>
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
                                @if($report->status == 'Pending')
                                    <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $report->id  }})">Edit</button>
                                    <form action="{{ route('pelapor.delete', ['id' => $report->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger ButtonAksi">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                        <label for="satker">SATKER</label>
                        <input class="form-control" type="text" name="satker" id="satker" readonly value="{{ $auth->role_user }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_user">Nama User</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly value="{{ $auth->nama_user }}">
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
                    <div class="mb-3">
                        <label for="penanganan">Penanganan</label>
                        <textarea class="form-control" id="penanganan" name="penanganan" rows="4" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
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

