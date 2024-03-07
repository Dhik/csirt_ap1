@extends('layout.AdminLayout')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Pengaturan Carousell</h2>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success ms-2 addButton" onclick="tampilkanModal('store')">Tambah Carousell</button>
                </div>
                @include('administrator.components._table-carousel')
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Konten -->
@include('administrator.components._tambahEdit-carousel')

@push('scripts')
    <script>
        function tampilkanModal(action, id = null) {
            $('#tambahKontenModal').modal('show');
            // Clear the form fields when showing the modal for adding or editing carousel
            $('#editForm')[0].reset();
    
            // Set the form method and action based on the provided action
            if (action === 'store') {
                $('#editForm').attr('method', 'post');
                $('#editForm').attr('action', '{{ route("carousel.storeOrUpdate") }}');
                $('#formMethod').val('store');
            } else if (action === 'update' && id) {
                // Use AJAX to fetch the existing data for the carousel
                $.ajax({
                    url: "{{ url('/carousel/show/') }}" + '/' + id,
                    type: 'GET',
                    success: function (data) {
                        // Fill the form fields with the existing data
                        $('#editCarouselId').val(data.id);
                        $('#heading_caption').val(data.heading_caption);
                        $('#caption').val(data.caption);
    
                        // Manually trigger change event for file input to update the displayed file name
                        $('#image_path').next('.custom-file-label').html(data.image_path);
    
                        // Update the form method to the update route
                        $('#editForm').attr('action', '{{ route("carousel.storeOrUpdate") }}');
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
            var image_path = document.getElementById('image_path').value;
            if (!image_path ) {
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

@endsection
@section('title','Admin | Carousel Management')