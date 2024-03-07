@extends('layout.adminLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Konten</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-info ms-2 addButton">Lihat Preview</button>
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fitur</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i < 5; $i++)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>Beranda</td>
                                <td>
                                    @if ($i % 2 === 0)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger ButtonAksi" onclick="tampilkanModal({{ $i }}, 'Aktif')">Non-Aktifkan</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">{{ $i + 1 }}</th>
                                <td>Beranda</td>
                                <td>
                                    @if (($i + 1) % 2 === 0)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal({{ $i + 1 }}, 'Tidak Aktif')">Aktifkan</button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Activation Confirmation -->
<div class="modal fade" id="activationModal" tabindex="-1" aria-labelledby="activationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activationModalLabel">Konfirmasi Aktivasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="activationMessage">Apakah Anda yakin ingin mengubah status aktivasi?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="ubahStatusAktivasi()">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('title','Admin | Carousel Managemen')

@push('scripts')
<script>
    var selectedFeatureId;
    var selectedFeatureStatus;

    function tampilkanModal(featureId, status) {
        selectedFeatureId = featureId;
        selectedFeatureStatus = status;
        var activationMessage = 'Apakah Anda yakin ingin ' + (status === 'Aktif' ? 'menonaktifkan' : 'mengaktifkan') + ' fitur ini?';
        
        document.getElementById('activationMessage').innerText = activationMessage;
        $('#activationModal').modal('show');
    }

    function ubahStatusAktivasi() {
        // Perform the necessary action to update activation status
        console.log('Mengubah status aktivasi untuk Fitur ' + selectedFeatureId + ' menjadi ' + (selectedFeatureStatus === 'Aktif' ? 'Tidak Aktif' : 'Aktif'));

        // TODO: Add logic to update activation status using Ajax or other methods

        // Close the modal
        $('#activationModal').modal('hide');
    }
</script>
@endpush
