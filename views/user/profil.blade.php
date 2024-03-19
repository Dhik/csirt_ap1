@extends('layout.userLayout')
@section('title', 'Tentang Kami | Profil')
@section('content')
<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb breadTop">
        <ol class="breadcrumb profilCrumb">
            <li class="breadcrumb-item">Tentang Kami</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Profil</a></li>
        </ol>
    </div>
    <h3 class="headingProfil">Profil</h3>
    <hr>
    <div class="profilNew">
        <img src="/img/headProfil.svg" alt="headProfil" style="background-color:#F5F9FF;">
        <p class="penjelasanProfil" style="background-color:#F5F9FF; width: 100% " ><b>Tim Tanggap Insiden Siber/Computer Security Inicident Response Team Angkasa Pura I (AP1-CSIRT) </b>ditetapkan oleh Ketua AP1-CSIRT Tim Tanggap Insiden Siber di Lingkungan Angkasa Pura I. Dalam Angkasa Pura I, Direktur Komersial dan Pelayanan ditunjuk sebagai Ketua AP1-CSIRT dan ditugaskan untuk melaksanakan perumusan, perencanaan, pembangunan, pengoperasian, pengembangan, pengawasan, evaluasi dan anggaran terkait AP1-CSIRT.</p>
        <img class="gambarPofil" src="/img/gambarProfil.svg" alt="headProfil" style="background-color:#F5F9FF;">
        @foreach ($profils as $profil)
            <div  style="background-color:#F5F9FF; width: 100% " class="profilLayanan">
                <h6 style="color: #4F9E19">{{ $profil->jenis_layanan }}</h6>
                <p>{{ $profil->deskripsi }}</p>
            </div>
        @endforeach
    </div>
</div>

@endsection