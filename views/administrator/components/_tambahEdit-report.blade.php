<div class="modal fade" id="tambahKontenModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Laporan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('report.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="user_id" id="user_id" value="{{ $auth->id }}" hidden>
                    <input type="hidden" name="report_id" id="report_id" value="">
                    
                    <div class="mb-3">
                        <label for="satker">SATKER</label>
                        <input class="form-control" type="text" name="satker" id="satker" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_user">Nama User</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="insiden_type">Insiden Type</label>
                        <select class="form-control" id="insiden_type" name="insiden_type" required>
                            <option value="Malware">Malware</option>
                            <option value="DDoS">Serangan DDoS</option>
                            <option value="Phishing">Serangan Phishing</option>
                            <option value="SQL Injection">Serangan SQL Injection</option>
                            <option value="Web Defacement">Web Defacement</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="penanganan">Penanganan</label>
                        <textarea class="form-control" id="penanganan" name="penanganan" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Close">Close</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bukti">Bukti</label>
                        <input type="file" class="form-control" id="bukti" name="bukti" onchange="updateFileName()">
                        <div id="filename-preview"></div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="tutupModal()">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>