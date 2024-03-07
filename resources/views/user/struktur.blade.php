@extends('layout.userLayout')
@section('title', 'Tentang Kami | Struktur')
@section('content')

<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb breadTop">
        <ol class="breadcrumb visiMisiCrumb">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Struktur Organisasi</a></li>
        </ol>
    </div>
    <h3 class="headingVisiMisi">Struktur Organisasi</h3>
    <hr>
    <div>
        @if (!$strukturs->isEmpty() && $strukturs->first()->gambar)
            <img src="{{ asset('storage/' . $strukturs->first()->gambar) }}" class="img-fluid" alt="Struktur Organisasi" style="margin-block:30px">
        @else
            <img src="/img/strukturOrganisasi.png" class="img-fluid" alt="Profil" style="margin-block:30px">
        @endif
    </div>
</div>

@endsection
