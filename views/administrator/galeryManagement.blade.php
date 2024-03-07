@extends('layout.AdminLayout')
@section('content')
@section('title', 'Admin | Galery')

<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Galeri</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah Galeri</button>
                </div>
                @include('administrator.components._table-galeri')
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Konten -->
@include('administrator.components._tambahEdit-galeri')
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
                $('#editForm').attr('action', '{{ route("galleries.storeOrUpdate") }}');
                $('#formMethod').val('store');
            } else if (action === 'update' && id) {
                // Use AJAX to fetch the existing data for the gallery
                $.ajax({
                    url: "{{ url('/galleries/show/') }}" + '/' + id,
                    type: 'GET',
                    success: function (data) {
                        // Fill the form fields with the existing data
                        $('#editGalleryId').val(data.id);
                        $('#editJudul').val(data.judul);
                        $('#editCaption').val(data.caption);
                        // Update the form method to the update route
                        $('#editForm').attr('action', '{{ route("galleries.storeOrUpdate") }}');
                        // Update the form method to 'update'
                        $('#formMethod').val('update');
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        }

        document.getElementById('editForm').addEventListener('submit', function (event) {
            var judul = document.getElementById('editJudul').value;
            var isiCaption = document.getElementById('editCaption').value;


            if (!judul || !isiCaption) {
                alert('Harap isi semua kolom yang wajib diisi.');
                event.preventDefault(); 
            }
        });

        function tutupModal() {
            $('#tambahKontenModal').modal('hide');
        }

        var msg = '{{Session::get('message')}}';
        var exist = '{{Session::has('message')}}';
        if(exist){
            alert(msg);
        }
        
    </script>
@endpush