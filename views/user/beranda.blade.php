@extends('layout.userLayout')
@section('title','Beranda')
@section('content')
        
    <div class="main-wrapper">
        <div id="carouselExample" class="carousel slide position-relative" >
            <div class="carousel-inner" style="max-height: 600px">
                @include('user.components._carousel-item')
                <!-- Container for ARTIKEL DAN BERITA -->
                <div class="containerAJudul w-100 position-absolute px-5">
                    <h4 >| ARTIKEL DAN BERITA</h4>
        
                </div>
            </div>
            @include('user.components._carousel-move')
        </div>
        <div class="container">
            <div class="head containerContent">
                <div class="judul">
                    <h2>INFO SIBER</h2>
                    @if($latestContent)
                        <p>Terakhir update: {{ $latestContent->updated_at->format('d/m/Y') }}</p>
                    @else
                        <p>Terakhir update: Tidak ada informasi</p>
                    @endif
                </div>
            </div>
        
        
            <hr>
            <div class="main main-desk">
                @if($content->count() > 3)
                
                    <div class="kiri">
                        @include('user.components._konten-berita-kiri')
                    </div>
                    <div class="kanan">
                        @include('user.components._konten-berita-kanan')
        
                        @if($content->count() > 5)
                            <div class="lihatSemua">
                                <a href="{{ route('daftarBerita') }}" >Lihat Semua</a>
                            </div>
                        @endif
                    </div>
                @else
                    @if($content->count() > 0)
                        @foreach($content->take(1) as $item)
                            <div>
                                <div style="text-align: center; margin: auto">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="width: 80%;">
                                </div>
                                <p style="color: #66B82E;font-style: italic;font-size: 13px;padding:0;margin:0;">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                                <h3 style="margin-top: 15px">{{$item->judul}}</h3>
                                <p style="text-align: justify;">{{ \Illuminate\Support\Str::limit($item->isi_konten, 1000) }}</p>
                                <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkap"><b>> Selengkapnya</b></a>
                            </div>
                        @endforeach
        
                    @else
                        <p>No content available</p>
                    @endif
                @endif
            </div>

            <div class="main-tab">
                @foreach($content->take(1) as $item)
                    <div class="beritaAtasTablet">
                        <div style="text-align: center;margin:0;padding:0" class="imgDivBeritaKiri">
                            <img class="img-fluid" src="{{ asset('storage/' . $item->gambar) }}" alt="content">
                        </div>
                        <p class="dateTab">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                        <h3>{{ \Illuminate\Support\Str::limit($item->judul, 50) }}</h3>
                        <p style="text-align: justify;" class="kontenTab">{{ \Illuminate\Support\Str::limit($item->isi_konten, 550) }}</p>
                        <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkapTab"><b>> Selengkapnya</b></a>
                    </div>
                @endforeach
                @foreach($content as $index => $item)
                    @if($index < 6 && $index >= 1) 
                        <a href="{{ route('berita', ['id' => $item->id]) }}" >
                            <div class="beritaBawahTablet">
                                    <div class="contentBeritaBawah">
                                        <h4 class="judulBeritaBawahTab">{{ \Illuminate\Support\Str::limit($item->judul, 20) }}</h4>
                                        <h4 class="judulBeritaBawahHp">{{ \Illuminate\Support\Str::limit($item->judul, 15) }}</h4>
                                        <p class="kontenBeritaBawahTab">{{ \Illuminate\Support\Str::limit($item->isi_konten, 150) }}</p>
                                        <p class="kontenBeritaBawahHp">{{ \Illuminate\Support\Str::limit($item->isi_konten, 30) }}</p>
                                        <p class="dateBeritaBawah" style="color: #66B82E;">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                                    </div>
                                    <div class="imgDivBeritaBawah">
                                        <img class="img-fluid" src="{{ asset('storage/' . $item->gambar) }}" alt="content">
                                    </div>
                            </div>
                        </a>
                    @endif
                @endforeach
                
            </div>
        
        </div>
        <div class="galery-head container-fluid position-relative">
            <img src="/img/galeryHead.svg" class="w-100" alt="Heading">
        </div>
        <div class="galeri-desk">
            <div id="galleryCarousel" class="carousel d-flex align-items-center justify-content-center">
                <div class="carousel-inner-galery">
                    @include('user.components._galery-item')
                </div>
                @include('user.components._galery-move')
            </div>
        </div>
        <div class="galeri-tab">
            <div id="galleryCarousel" class="carousel d-flex align-items-center justify-content-center">
                <div class="carousel-inner-galery">
                    @foreach($galleries->take(4) as $gallery)
                        <div class="carousel-item-galery mx-4">
                            <a href="{{ route('galeri', ['id' => $gallery->id]) }}" style="display: block;">
                                <img src="{{ asset('storage/' . $gallery->gambar) }}" class="d-block img-fluid" alt="{{ $gallery->judul }}">
                                <div class="bgGalery">
                                    <p class="text-white">{{ $gallery->caption }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev-galery" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="bi bi-chevron-left" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next-galery" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="bi bi-chevron-right" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let galleryIndex = 0;
    const galleryItems = document.querySelectorAll('.carousel-item-galery');
    const totalGalleryItems = galleryItems.length;

    function updateGallery() {
        galleryItems.forEach((item, index) => {
            const newIndex = (index - galleryIndex + totalGalleryItems) % totalGalleryItems;
            item.style.order = newIndex + 1;
        });
    }

    function showNextGallery() {
        galleryIndex = (galleryIndex + 1) % totalGalleryItems;
        updateGallery();
    }

    function showPrevGallery() {
        galleryIndex = (galleryIndex - 1 + totalGalleryItems) % totalGalleryItems;
        updateGallery();
    }

    // document.querySelector('.carousel-control-prev-galery').addEventListener('touchstart', showPrevGallery);
    // document.querySelector('.carousel-control-next-galery').addEventListener('touchstart', showNextGallery);
    document.querySelector('.carousel-control-prev-galery').addEventListener('click', showPrevGallery);
    document.querySelector('.carousel-control-next-galery').addEventListener('click', showNextGallery);

    updateGallery();
});





</script>
@endpush
