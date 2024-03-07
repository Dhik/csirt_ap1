@if($content->count() > 5)
    @if($content->count() > 0)
        @foreach($content->take(2) as $item)
            <div class="beritaKiri">
                <div style="text-align: center;margin:0;padding:0" class="imgDivBeritaKiri">
                    <img class="img-fluid" src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="max-height: 300px; margin-bottom: 10px">
                </div>
                <p class="dateKiriDesk" style="color: #66B82E;font-style: italic;">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                <h3 class="judulKiriDesk">{{ \Illuminate\Support\Str::limit($item->judul, 50) }}</h3>
                <p style="text-align: justify;" class="KontenKiriDesk">{{ \Illuminate\Support\Str::limit($item->isi_konten, 550) }}</p>
                <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkap"><b>> Selengkapnya</b></a>
            </div>
        @endforeach
    @else
        <p>No content available</p>
    @endif
@else
    @if($content->count() > 0)
        @foreach($content->take(1) as $item)
            <div>
                <div style="text-align: center">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="content" style="max-height: 300px; margin-top: 40px;margin-bottom: 10px">
                </div>
                <p class="dateDesk">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                <h3 style="margin-top: 15px">{{ \Illuminate\Support\Str::limit($item->judul, 50) }}</h3>
                <p style="text-align: justify;">{{ \Illuminate\Support\Str::limit($item->isi_konten, 550) }}</p>
                <a href="{{ route('berita', ['id' => $item->id]) }}" class="selengkap"><b>> Selengkapnya</b></a>
            </div>
        @endforeach
    @else
        <p>No content available</p>
    @endif
@endif