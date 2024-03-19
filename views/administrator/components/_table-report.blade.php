<table class="table align-middle text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">SATKER</th>
            <th scope="col">Nama User</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Insiden Type</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Penanganan</th>
            <th scope="col">Status</th>
            <th scope="col">Bukti</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
   
        
        @include('administrator.components._isi-table-report', ['reports' => $reports])
    </tbody>
</table>