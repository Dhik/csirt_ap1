@extends('layout.userLayout')
@section('title', 'Daftar Berita')
@section('content')

<div class="container">
    <div class="breadcrumb d-flex justify-content-between" style="padding-top: 100px; margin-bottom: 0;">
        <div>Daftar Berita | <a href="{{ route('user.beranda') }}">Kembali</a></div>
    </div>

    <div class="row" id="newsContainer">
        @foreach($content as $index => $item)
            <div class="col-md-4 mb-3" style="word-wrap: break-word; display: none;">
                <div class="contentBerita" style="margin:auto;">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="width: 100%; height: 150px; object-fit: cover;">
                    <h3 style="text-align: justify;" class="pt-2">{{ \Illuminate\Support\Str::limit($item->judul, 30) }}</h3>
                    <p style="text-align: justify; padding: 5px">{{ \Illuminate\Support\Str::limit($item->isi_konten, 100) }}</p>
                    <div style="text-align: left">
                        <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkapKanan"><b>> Selengkapnya</b></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($content->count() > 6)
        <div class="text-center mt-3" id="loadMoreContainer">
            <a href="#" style="color: #66B82E; font-size: 18px" id="loadMore" onclick="showMore()">Tampilkan Lebih Banyak</a>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let visibleItems = 6;
        const items = document.querySelectorAll('.col-md-4');
        const loadMoreContainer = document.getElementById('loadMoreContainer');
        const loadMoreButton = document.getElementById('loadMore');

        function showMore() {
            for (let i = visibleItems; i < visibleItems + 6 && i < items.length; i++) {
                items[i].style.display = 'block';
            }
            visibleItems += 6;

            if (visibleItems >= items.length) {
                if (loadMoreButton) {
                    loadMoreButton.style.display = 'none';
                }
            }
        }

        if (loadMoreContainer && loadMoreButton && items.length > 6) {
            loadMoreButton.addEventListener('click', showMore);
        } else if (loadMoreContainer) {
            // Hide the load more container if there are fewer than 6 items
            loadMoreContainer.style.display = 'none';
        }

        // Initially show the first set of items
        for (let i = 0; i < visibleItems && i < items.length; i++) {
            items[i].style.display = 'block';
        }
    });
</script>
@endpush
