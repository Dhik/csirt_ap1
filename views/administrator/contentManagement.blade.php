@extends('layout.AdminLayout')
@section('content')
@section('title', 'Admin | Artikel & Berita')

<div class="container-fluid">
    <div id="alertContainer" class="mt-3"></div>
    <div class="col-11 tableContent g-4">
        <div class="bg-light rounded h-100 p-4 ml-4">
            <h2 class="mb-4 text-center">Pengaturan Konten</h2>
            <div class="table-responsive ">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal()">Tambah Konten</button>
                </div>
                @include('administrator.components._table-content')
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Konten -->
@include('administrator.components._tambahEdit-content')

@endsection

@push('scripts')
    <script>
        function tampilkanModal() {
            $('#tambahKontenModal').modal('show');
            // Clear the form fields when showing the modal for adding or editing content
            $('#editForm')[0].reset();
            // Set the form method to POST
            $('#editForm').attr('method', 'post');
            // Update the form action to the create route
            $('#editForm').attr('action', '{{ route("contents.storeOrUpdate") }}');
            // Update the save button text
            $('#saveButton').text('Simpan');
            $('#formMethod').val('store');
            $formMethod = $('#formMethod').val('store');
        }

        function tampilkanEditModal(id) {
            // Use the direct route URL in the script
            var routeUrl = "/contents/" + id;

            // Use AJAX to fetch the existing data for the content
            $.ajax({
                url: routeUrl,
                type: 'GET',
                success: function (data) {
                    console.log('Server response:', data);

                    // Fill the form fields with the existing data
                    $('#editContentId').val(data.id);
                    $('#editJudul').val(data.judul);
                    $('#editIsiKonten').val(data.isi_konten);
                    $('#editType').val(data.type);
                    $('#formMethod').val('update');
                    $formMethod = $('#formMethod').val('update');

                    // Update the form action to the update route
                    $('#editForm').attr('action', '{{ route("contents.storeOrUpdate", ['id' => '']) }}' + '/' + id);
                    // Update the save button text
                    $('#saveButton').text('Update');

                    // Show the modal
                    $('#tambahKontenModal').modal('show');

                    // Display the filename preview
                    if (data.gambar) {
                        // Set the filename in the hidden input and preview
                        var buktiFilename = data.gambar;
                        console.log('Image filename:', buktiFilename);
                        $('#editGambar').val(buktiFilename);
                        console.log('Setting filename:', buktiFilename);
                        $('#filename-preview').text(buktiFilename);

                    } else {
                        // Clear the filename in the hidden input and preview
                        $('#editGambar').val(null); // Use null to clear the value
                        $('#filename-preview').text('No Image');
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        document.getElementById('editForm').addEventListener('submit', function (event) {
            var judul = document.getElementById('editJudul').value;
            var isiKonten = document.getElementById('editIsiKonten').value;
            var type = document.getElementById('editType').value;

            if (!judul || !isiKonten || !gambar || !type) {
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