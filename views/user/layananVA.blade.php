@extends('layout.userLayout')
@section('title', 'Layanan | Layanan VA')
@section('content')
<div class="container text-black" style="background-color: white;">
    <div class="breadcrumb breadTop">
        <ol class="breadcrumb aduanCrumb">
            <li class="breadcrumb-item">Layanan</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Layanan VA</a></li>
        </ol>
    </div>
    <div > 
        <h6 class="headingVisiMisi">Layanan VA</h6>
        <hr>
        <div class="aduanSiber" >
            <p><b style="color: rgba(0, 0, 0, 0.8);">Layanan Vulnerability Assesment (VA)</b> dikhususkan bagi konstituen CSIRT Angkasa Pura I yaitu PT Angkasa Pura I dan seluruh kantor cabang dibawahnya. Adapun informasi yang perlu disiapkan untuk pengajuan layanan ini adalah :</p>
            <ol>
                @foreach ($vas as $va)
                    <li><p>{{ $va->informasi_va }}</p></li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endsection
