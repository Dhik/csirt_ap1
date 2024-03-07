<div class="modal fade" id="tambahKontenModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konten</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" enctype="multipart/form-data" action="{{ route('contents.storeOrUpdate') }}">
                    @csrf
                    <input type="hidden" id="formMethod" name="formMethod" value="">
                    <input type="hidden" name="content_id" id="editContentId" value="">
                    <div class="mb-3">
                        <label for="editJudul">Judul</label>
                        <input type="text" class="form-control" id="editJudul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="editIsiKonten">Isi Konten</label>
                        <textarea class="form-control" id="editIsiKonten" name="isiKonten" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editGambar">Gambar</label>
                        <input type="file" class="form-control" id="editGambar" name="gambar" onchange="updateFileName()">
                        <div id="filename-preview"></div>
                    </div>
                    <div class="mb-3">
                        <label for="editType">Type</label>
                        <select class="form-select" id="editType" name="type">
                            <option value="Artikel">Artikel</option>
                            <option value="Berita">Berita</option>
                        </select>
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
