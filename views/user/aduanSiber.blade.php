@extends('layout.userLayout')
@section('title', 'Layanan | Aduan Siber')
@section('content')

<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb breadTop">
        <ol class="breadcrumb aduanCrumb">
            <li class="breadcrumb-item ">Layanan</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Aduan Siber</a></li>
        </ol>
    </div>
    <h3 class="headingVisiMisi">Aduan Siber</h3>
    <hr>
    <div class="aduanSiber">
        
        <h6 >Prosedur Aduan Siber</h6>
        <ol>
            @foreach ($aduans as $aduan)
                <li><p>{{ $aduan->prosedur }}</p></li>
            @endforeach
        </ol>
        
        <hr>
        <div class="imgAduan">
            <img src="/img/aduanSiber.png" alt="aduan" class="img-fluid" >
        </div>
    </div>
</div>

@endsection