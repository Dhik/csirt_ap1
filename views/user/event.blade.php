@extends('layout.userLayout')
@section('title', 'Event Kami')
@section('content')

<div class="container eventStyle" >
    <h3>Event Siber</h3>
    <hr>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><h5>Acara</h5></th>
                    <th scope="col"><h5>Deskripsi</h5></th>
                    <th scope="col"><h5>Tanggal Awal</h5></th>
                    <th scope="col"><h5>Tanggal Akhir</h5></th>
                    <th scope="col"><h5>Tempat</h5></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td scope="col"><p>{{ $event->name }}</p></td>
                    <td scope="col"><p>{{ $event->description }}</p></td>
                    <td scope="col"><p>{{ $event->start_date }}</p></td>
                    <td scope="col"><p>{{ $event->end_date }}</p></td>
                    <td scope="col"><p>{{ $event->location }}</p></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
