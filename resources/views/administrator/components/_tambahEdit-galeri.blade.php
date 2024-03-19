<div class="modal fade" id="tambahKontenModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Galeri</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" enctype="multipart/form-data" action="{{ route('galleries.storeOrUpdate') }}">
                    @csrf
                    <input type="hidden" id="formMethod" name="formMethod" value="">
                    <input type="hidden" name="gallery_id" id="editGalleryId" value="">
                    <div class="mb-3">
                        <label for="editJudul">Judul</label>
                        <input type="text" class="form-control" id="editJudul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCaption">Caption</label>
                        <textarea class="form-control" id="editCaption" name="caption" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar">Gambar</label>
                        <input type="file" class="form-control" id="editGambar" name="gambar" >
                    </div>
                    <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="tutupModalButton" onclick="tutupModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>