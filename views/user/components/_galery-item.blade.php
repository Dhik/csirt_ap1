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
