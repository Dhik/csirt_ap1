@foreach ($events as $event)
<tr>
    <th scope="row"><p>{{ $loop->iteration }}</p></th>
    <td><p>{{ $event->name }}</p></td>
    <td><p>{{ $event->description }}</p></td>
    <td><p>{{ $event->start_date }}</p></td>
    <td><p>{{ $event->end_date }}</p></td>
    <td><p>{{ $event->location }}</p></td>
    <td>
        <button class="btn btn-sm btn-primary ButtonAksi" onclick="tampilkanModal( 'update', {{ $event->id }})"><p>Edit</p></button>
        <form action="{{ route('events.delete', ['id' => $event->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this event?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger ButtonAksi"><p>Hapus</p></button>
        </form>
    </td>
</tr>
@endforeach