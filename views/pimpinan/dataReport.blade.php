@extends('layout.pimpinanLayout')
@section('content')
<style>
    /* Custom CSS to set the height of td elements */
    table td {
        height: 60px; /* You can adjust the height value as needed */
    }
</style>
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data Laporan</h2>
            <div class="table-responsive">
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $report->satker }}</td>
                            <td>{{ $report->user->nama_user }}</td>
                            <td>{{ $report->tanggal }}</td>
                            <td>{{ $report->insiden_type }}</td>
                            <td>{{ $report->keterangan }}</td>
                            <td>{{ $report->penanganan }}</td>
                            <td>{{ $report->status }}</td>
                            <td>
                                @if($report->bukti)
                                    <img src="{{ Storage::url('/' . $report->bukti) }}" alt="Bukti" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                           
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('title','Pimpinan | Report Managemen')
