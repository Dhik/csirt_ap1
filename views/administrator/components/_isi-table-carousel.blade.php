@foreach ($carousels as $carousel)
    <tr>
        <th scope="row"><p>{{ $loop->iteration }}</p></th>
        <td><p>{{ $carousel->heading_caption }}</p></td>
        <td><p>{{ $carousel->caption }}</p></td>
        <td><img src="{{ asset('storage/' .$carousel->image_path) }}" alt="Carousel Image" class="img-fluid"></td>
        <td>
            <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal('update', {{ $carousel->id }})"><p>Edit</p></button>
            <form action="{{ route('carousel.delete', ['id' => $carousel->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this content?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger ButtonAksi"><p>Hapus</p></button>
            </form>
        </td>
    </tr>
@endforeach