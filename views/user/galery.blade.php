@extends('layout.userLayout')
@section('title', 'Galeri')
@section('content')

<div class="container">
    <div class="breadcrumb d-flex justify-content-between" style="padding-top: 100px; margin-bottom: 0;">
        <div>Galeri | <a href="{{ route('user.beranda') }}">Kembali</a></div>
    </div>

    <div class="row mt-3" style="padding-top: 40px">
        <div class="col-md-6">
            <div class="kiriGalery">
                <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="Galery" style="width: 100%;">
            </div>
        </div>
        <div class="col-md-6">
            <div class="kananGalery p-5">
                @if ($prevGallery)
                    <a href="{{ route('galeri', $prevGallery->id) }}">Sebelumnya</a>
                @endif
                <h3 style="margin-top: 30px">{{ $gallery->judul }}</h3>
                <hr style="margin-top: 15px; margin-bottom: 8px;">
                <p style="color: #66B82E;font-style: italic;font-size: 14px;padding:0;margin:0;">{{ \Carbon\Carbon::parse($gallery->updated_at)->format('d M Y') }}</p>

                <p style="margin-top: 10px; font-size: 16px">{{$gallery->caption}}</p>
                @if ($nextGallery)
                    <a href="{{ route('galeri', $nextGallery->id) }}" class="float-end" style="margin-top: 30px;">Selanjutnya</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
