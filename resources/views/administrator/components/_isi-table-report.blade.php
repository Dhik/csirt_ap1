@foreach($reports as $report)
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{ $report->satker }}</td>
    <td>{{ $report->user->nama_user }}</td>
    <td>{{ $report->tanggal }}</td>
    <td>{{ $report->insiden_type }}</td>
    <td>{{ $report->keterangan }}</td>
    @if ($report->penanganan != '-')
        <td style="color:#87A922; ">{{ $report->penanganan }}</td>
    @else
        <td>{{ $report->penanganan }}</td>
    @endif
    <td>{{ $report->status }}</td>
    <td>
        @if($report->bukti)
            <img src="{{ Storage::url('/' . $report->bukti) }}" alt="Bukti" style="max-width: 100px; max-height: 100px;">
        @else
            No Image
        @endif
    </td>
    <td>
        <button class="btn btn-sm btn-primary ButtonAksi" style="width: 60px;" onclick="tampilkanModal('{{ $report->id }}')">Update</button>
        <form method="POST" action="{{ route('report.delete', $report->id) }}" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" style="width: 60px;" class="btn btn-sm btn-danger ButtonAksi" onclick="return confirm('Are you sure?')">Hapus</button>
        </form>
    </td>
    
</tr>
@endforeach