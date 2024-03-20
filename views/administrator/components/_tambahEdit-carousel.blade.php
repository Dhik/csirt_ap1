<div class="modal fade" id="tambahKontenModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Carousell</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" enctype="multipart/form-data" action="{{ route('carousel.storeOrUpdate') }}">
                    @csrf
                    <input type="hidden" id="formMethod" name="formMethod" value="">
                    <input type="hidden" name="carousel_id" id="editCarouselId" value="">
                    <div class="mb-3">
                        <label for="heading_caption">Heading Caption</label>
                        <input type="text" class="form-control" id="heading_caption" name="heading_caption">
                    </div>
                    <div class="mb-3">
                        <label for="caption">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption">
                    </div>
                    <div class="mb-3">
                        <label for="image_path">Gambar</label>
                        <input type="file" class="form-control" id="image_path" name="image_path">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>