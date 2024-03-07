@foreach ($galleries as $gallery)
    <tr>
        <th scope="row"><p>{{ $loop->iteration }}</p></th>
        <td><p>{{ $gallery->judul }}</p></td>
        <td><p>{{ $gallery->caption }}</p></td>
        <td><img src="{{ asset('storage/' . $gallery->gambar) }}" alt="Gambar" class="img-fluid"></td>
        <td>
            <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $gallery->id }})"><p>Edit</p></button>
            <form action="{{ route('gallery.delete', ['id' => $gallery->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger ButtonAksi"><p>Hapus</p></button>
            </form>
        </td>
    </tr>
@endforeach