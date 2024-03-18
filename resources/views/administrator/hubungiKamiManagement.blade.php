@extends('layout.AdminLayout')
@section('content')
@section('title', 'Admin | Hubungi Kami Management')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Hubungi Kami</h2>
            <div class="table-responsive">
                @if (count($contacts) == 0)
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Buat Contact</button>
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><h6>#</h6></th>
                            <th scope="col"><h6>Lokasi</h6></th>
                            <th scope="col"><h6>Seluler</h6></th>
                            <th scope="col"><h6>Link Maps</h6></th>
                            <th scope="col"><h6>Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr>
                            <th scope="row"><p>{{ $loop->iteration }}</p></th>
                            <td><p>{{ $contact->lokasi }}</p></td>
                            <td><p>{{ $contact->nomor_hp }}</p></td>
                            <td><p>{{ $contact->maps }}</p></td>
                            <td>
                                <button class="btn btn-sm btn-primary ButtonAksi" style="width: 60px;" onclick="tampilkanModal( 'update', {{ $contact->id }})"><p>Edit</p></button>
                                <form action="{{ route('contacts.delete', ['id' => $contact->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this Contact?')">
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
                <h5 class="modal-title">Hubungi Kami</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('contacts.storeOrUpdate') }}" method="post" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <input type="hidden" name="formMethod" id="formMethod" value="">
                    <input type="hidden" name="contact_id" id="contact_id" value="">
                    <div class="mb-3">
                        <label for="name">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi">
                    </div>
                    <div class="mb-3">
                        <label for="name">Seluler</label>
                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp">
                    </div>
                    <div class="mb-3">
                        <label for="name">Link Maps</label>
                        <input type="text" class="form-control" id="maps" name="maps">
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
            $('#editForm').attr('action', '{{ route("contacts.storeOrUpdate") }}');
            $('#formMethod').val('store');
        } else if (action === 'update' && id) {
            // Use AJAX to fetch the existing data for the gallery
            $.ajax({
                url: "{{ url('/contacts/show/') }}" + '/' + id,
                type: 'GET',
                success: function (data) {
                    // Fill the form fields with the existing data
                    $('#contact_id').val(data.id);
                    $('#lokasi').val(data.lokasi);
                    $('#nomor_hp').val(data.nomor_hp);
                    $('#maps').val(data.maps);
                    // Update the form method to the update route
                    $('#editForm').attr('action', '{{ route("contacts.storeOrUpdate") }}');
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