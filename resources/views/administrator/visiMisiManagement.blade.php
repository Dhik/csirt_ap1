@extends('layout.AdminLayout')
@section('content')
@section('title', 'Admin | Visi Misi Management')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Visi Misi</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModalVisi('store')">Tambah Visi</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><h6>#</h6></th>
                            <th scope="col"><h6>Visi</h6></th>
                            <th scope="col"><h6>Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visis as $visi)
                        <tr>
                            <th scope="row"><p>{{ $loop->iteration }}</p></th>
                            <td><p>{{ $visi->visi }}</p></td>
                            <td>
                                <button class="btn btn-sm btn-primary ButtonAksi" style="width: 60px;" onclick="tampilkanModalVisi( 'update', {{ $visi->id }})"><p>Edit</p></button>
                                <form action="{{ route('visis.delete', ['id' => $visi->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this visi?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="width: 60px;" class="btn btn-sm btn-danger ButtonAksi"><p>Hapus</p></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah Misi</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><h6>#</h6></th>
                            <th scope="col"><h6>Misi</h6></th>
                            <th scope="col"><h6>Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($misis as $misi)
                        <tr>
                            <th scope="row"><p>{{ $loop->iteration }}</p></th>
                            <td><p>{{ $misi->misi }}</p></td>
                            <td>
                                <button class="btn btn-sm btn-primary ButtonAksi" style="width: 60px;" onclick="tampilkanModal( 'update', {{ $misi->id }})"><p>Edit</p></button>
                                <form action="{{ route('misis.delete', ['id' => $misi->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this misi?')">
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
                        <label for="name">Misi</label>
                        <input type="text" class="form-control" id="misi" name="misi">
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
<div class="modal fade" id="tambahKontenModalVisi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Visi</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('visis.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editFormVisi">
                    @csrf
                    <input type="hidden" name="formMethodVisi" id="formMethodVisi" value="">
                    <input type="hidden" name="visi_id" id="visi_id" value="">
                    <div class="mb-3">
                        <label for="name">Visi</label>
                        <input type="text" class="form-control" id="visi" name="visi">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModalVisi()">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    function tampilkanModalVisi(action, id = null) {
        $('#tambahKontenModalVisi').modal('show');
        // Clear the form fields when showing the modal for adding or editing gallery
        $('#editFormVisi')[0].reset();
        // Set the form method and action based on the provided action
        if (action === 'store') {
            $('#editFormVisi').attr('method', 'post');
            $('#editFormVisi').attr('action', '{{ route("visis.storeOrUpdate") }}');
            $('#formMethodVisi').val('store');
        } else if (action === 'update' && id) {
            // Use AJAX to fetch the existing data for the gallery
            $.ajax({
                url: "{{ url('/visis/show/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    // Fill the form fields with the existing data
                    $('#visi_id').val(data.id);
                    $('#visi').val(data.visi);
                    // Update the form method to the update route
                    $('#editFormVisi').attr('action', '{{ route("visis.storeOrUpdate") }}');
                    // Update the form method to 'update'
                    $('#formMethodVisi').val('update');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    }

    document.getElementById('editForm').addprofilListener('submit', function (profil) {
        var visi = document.getElementById('visi').value;

        if (!visi) {
            alert('Harap isi semua kolom yang wajib diisi.');
            profil.prprofilDefault();
        }
    });

    function tutupModalVisi() {
        $('#tambahKontenModalVisi').modal('hide');
    }

    var msg = '{{Session::get('message')}}';
    var exist = '{{Session::has('message')}}';
    if (exist) {
        alert(msg);
    }

</script>
<script>
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
                url: "{{ url('/misis/show/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    // Fill the form fields with the existing data
                    $('#misi_id').val(data.id);
                    $('#misi').val(data.misi);
                    // Update the form method to the update route
                    $('#editForm').attr('action', '{{ route("misis.storeOrUpdate") }}');
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
@endpush
