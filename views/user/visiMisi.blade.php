@extends('layout.userLayout')
@section('title', 'Tentang Kami | Visi Misi')
@section('content')

<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb breadTop">
        <ol class="breadcrumb visiMisiCrumb">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Visi Misi</a></li>
        </ol>
    </div>
    <h3 class="headingVisiMisi">Visi Misi</h3>
    <hr>
    <div class="visiNew">
        <img src="/img/gambarVisi.svg" alt="gambarVisi" style="background-color:#F5F9FF;">
        <div style="background-color:#F5F9FF;" class="visiIsi">
            <h6 >Visi</h6>
            @foreach ($visis as $visi)
                <div >
                    <p >{{ $visi->visi }}</p>
                </div>
            @endforeach
        </div>
        <div class="misiIsi">
            <h6>Misi</h6>
            <ul style="list-style-type: square; color: #66B82E;">
                @foreach ($misis as $misi)
                    <li><p style="color: #202020;">{{ $misi->misi }}</p></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
