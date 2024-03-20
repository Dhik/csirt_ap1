@extends('layout.AdminLayout')
@section('content')
@section('title', 'Admin | Struktur Management')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Struktur</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    @if (!$strukturs->isEmpty())
                        <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah Struktur</button>
                    @else
                        <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah Gambar</button>
                    @endif
                </div>
                <table class="table align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col"><h6>#</h6></th>
                            <th scope="col"><h6>Struktur</h6></th>
                            <th scope="col"><h6>Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($strukturs->isEmpty())
                            <tr>
                                <td colspan="3" class="imgStruktur">
                                    <img src="/img/strukturOrganisasi.png" alt="Placeholder" class="img-fluid">
                                </td>
                            </tr>
                        @else
                            @foreach ($strukturs as $struktur)
                                <tr>
                                    <th scope="row"><p>{{ $loop->iteration }}</p></th>
                                    <td>
                                        @if ($struktur->gambar)
                                            <img src="{{ asset('storage/' . $struktur->gambar) }}" alt="Gambar" class="img-fluid">
                                        @else
                                            <img src="/img/strukturOrganisasi.png" alt="Gambar" class="img-fluid">
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal( 'update', {{ $struktur->id }})"><p>Edit</p></button>
                                        <form action="{{ route('strukturs.delete', ['id' => $struktur->id]) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this struktur?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger ButtonAksi"><p>Hapus</p></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
                <h5 class="modal-title">Misi</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('misis.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <input type="hidden" name="formMethod" id="formMethod" value="">
                    <input type="hidden" name="misi_id" id="misi_id" value="">
                    <div class="mb-3">
                        <label for="name">Acara</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="description">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description">
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


@endsection

@push('scripts')
{{-- <script>
    function tampilkanModal(action, id = null) {
        $('#tambahKontenModal').modal('show');
        // Clear the form fields when showing the modal for adding or editing gallery
        $('#editForm')[0].reset();
        // Set the form method and action based on the provided action
        if (action === 'store') {
            $('#editForm').attr('method', 'post');
            $('#editForm').attr('action', '{{ route("misis.storeOrUpdate") }}');
            $('#formMethod').val('store');
        } else if (action === 'update' && id) {
            // Use AJAX to fetch the existing data for the gallery
            $.ajax({
                url: "{{ url('/profils/show/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    // Fill the form fields with the existing data
                    $('#profil_id').val(data.id);
                    $('#name').val(data.name);
                    $('#description').val(data.description);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                    $('#location').val(data.location);
                    // Update the form method to the update route
                    $('#editForm').attr('action', '{{ route("profils.storeOrUpdate") }}');
                    // Update the form method to 'update'
                    $('#formMethod').val('update');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    }

    document.getElementById('editForm').addprofilListener('submit', function (profil) {
        var name = document.getElementById('name').value;
        var description = document.getElementById('description').value;
        var start_date = document.getElementById('start_date').value;
        var end_date = document.getElementById('end_date').value;
        var location = document.getElementById('location').value;

        if (!name || !description || !start_date || !end_date || !location) {
            alert('Harap isi semua kolom yang wajib diisi.');
            profil.prprofilDefault();
        }
    });

    function tutupModal() {
        $('#tambahKontenModal').modal('hide');
    }

    var msg = '{{Session::get('message')}}';
    var exist = '{{Session::has('message')}}';
    if (exist) {
        alert(msg);
    }

</script>
  --}}

@endpush