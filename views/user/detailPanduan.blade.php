<!-- DetailPanduans.blade.php -->
@extends('layout.userLayout')
@section('title', 'Layanan | Panduan Teknis')
@section('content')

<div class="container">
    <div class="breadcrumb" style="padding-top: 100px; margin-bottom: 0;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Layanan</a></li>
            <li class="breadcrumb-item"><a href="#">Panduan Teknis</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $panduans->filename }}</li>
        </ol>
    </div>
    <h3>s Teknis</h3>
    <hr style="margin-bottom: 30px;">

    <div style="margin-bottom: 20px; text-align: center">
        <h4>{{ $panduans->filename }}</h4>
    </div>

    <object data="{{ url( 'file/'.$panduans->file) }}" type="application/pdf" width="100%" height="1000px">
        <embed src="{{ url( 'file/'. $panduans->file) }}" type="application/pdf" />
    </object>
</div>

@endsection
