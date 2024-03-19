@extends('layout.AdminLayout')
@section('content')
@section('title', 'Admin | Visi aduan Management')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Langkah Aduan</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah Langkah Aduan</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><h6>#</h6></th>
                            <th scope="col"><h6>Prosedur</h6></th>
                            <th scope="col"><h6>Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aduans as $aduan)
                        <tr>
                            <th scope="row"><p>{{ $loop->iteration }}</p></th>
                            <td><p>{{ $aduan->prosedur }}</p></td>
                            <td>
                                <button class="btn btn-sm btn-primary ButtonAksi" style="width: 60px;" onclick="tampilkanModal( 'update', {{ $aduan->id }})"><p>Edit</p></button>
                                <form action="{{ route('aduans.delete', ['id' => $aduan->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this aduan?')">
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
                <h5 class="modal-title">Langkah Aduan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('aduans.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <input type="hidden" name="formMethod" id="formMethod" value="">
                    <input type="hidden" name="aduan_id" id="aduan_id" value="">
                    <div class="mb-3">
                        <label for="name">Prosedur</label>
                        <input type="text" class="form-control" id="prosedur" name="prosedur">
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
<script>
    function tampilkanModal(action, id = null) {
        $('#tambahKontenModal').modal('show');
        // Clear the form fields when showing the modal for adding or editing gallery
        $('#editForm')[0].reset();
        // Set the form method and action based on the provided action
        if (action === 'store') {
            $('#editForm').attr('method', 'post');
            $('#editForm').attr('action', '{{ route("aduans.storeOrUpdate") }}');
            $('#formMethod').val('store');
        } else if (action === 'update' && id) {
            // Use AJAX to fetch the existing data for the gallery
            $.ajax({
                url: "{{ url('/aduans/show/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    // Fill the form fields with the existing data
                    $('#aduan_id').val(data.id);
                    $('#prosedur').val(data.prosedur);
                    // Update the form method to the update route
                    $('#editForm').attr('action', '{{ route("aduans.storeOrUpdate") }}');
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