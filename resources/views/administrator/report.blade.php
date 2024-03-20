@extends('layout.AdminLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data Laporan</h2>
            <div class="table-responsive">
                @if(count($reports) > 0)
                @include('administrator.components._table-report', ['reports' => $reports])

                @else
                    <p class="text-center">No data available</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Konten -->
@include('administrator.components._tambahEdit-report', ['reports' => $reports])


@push('scripts')
<script>
    // Variable untuk menyimpan nama file
    var buktiFilename = '';

    function tampilkanModal(reportId) {
        var report = {!! json_encode($reports) !!}.find(report => report.id == reportId);

        $('#tambahKontenModal').modal('show');
        $('#report_id').val(report.id);
        $('#tanggal').val(report.tanggal);
        $('#insiden_type').val(report.insiden_type);
        $('#keterangan').val(report.keterangan);
        $('#penanganan').val(report.penanganan);
        $('#status').val(report.status);
        // Set SATKER and Nama User values
        $('#satker').val(report.satker);
        $('#nama_user').val(report.nama_user);

        // Check if the report has a bukti (image)
        if (report.bukti) {
            // Set the filename in the hidden input and preview
            buktiFilename = report.bukti;
            $('#bukti-filename').val(buktiFilename);
            $('#filename-preview').text(buktiFilename);
        } else {
            // Clear the filename in the hidden input and preview
            buktiFilename = '';
            $('#bukti-filename').val(buktiFilename);
            $('#filename-preview').text('No Image');
        }
    }

    function updateFileName() {
        var buktiInput = $('#bukti');
        var filename = buktiInput.val().replace(/^.*[\\\/]/, '');

        // Menetapkan nama file ke dalam hidden input dan preview
        buktiFilename = filename;
        $('#bukti-filename').val(buktiFilename);
        $('#filename-preview').text(buktiFilename);
    }

    function tutupModal() {
        // Membersihkan variabel nama file ketika menutup modal
        buktiFilename = '';
        $('#tambahKontenModal').modal('hide');
    }
    var msg = '{{Session::get('message')}}';
    var exist = '{{Session::has('message')}}';
    if(exist){
        alert(msg);
    }
</script>
@endpush
@endsection
@section('title','Admin | Report Managemen')