@extends('layout.userLayout')
@section('title', 'Layanan | Panduan Teknis')
@section('content')
<div class="container">
    <div class="breadcrumb breadTop" >
        <ol class="breadcrumb aduanCrumb">
            <li class="breadcrumb-item">Layanan</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Panduan Teknis</a></li>
        </ol>
    </div>
    <h3 class="headingVisiMisi">Panduan Teknis</h3>
    <hr>

    <div class="text-center panduan">
        <h6>Daftar Panduan</h6>
    </div>

    <table class="table panduan" style="border-collapse: collapse; width: 100%; margin: auto;">
        <tbody>
            @foreach($panduans as $panduan)
            <tr>
                <td style="border-bottom: 1px solid #dee2e6;display: flex;justify-content: space-between;align-content: center">
                    <a href="{{ route('detailPanduan', ['filename' => $panduan->filename]) }}" style="margin: 0;padding: 0">
                        <p class="filename">{{ $panduan->filename }}</p>
                    </a>                    
                    <span id="file_size_{{ urlencode($panduan->filename) }}" style="float: right;"><p>(PDF - Loading...)</p></span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<!-- Tambahkan ini pada akhir konten Anda -->
@push('scripts')
<script>
    // Fungsi untuk mengambil ukuran file dan menambahkannya ke elemen span
    function getFileSize(url, spanId) {
        var xhr = new XMLHttpRequest();
        xhr.open('HEAD', url, true);
        xhr.onreadystatechange = function () {
            if (this.readyState === this.DONE) {
                if (this.status === 200) {
                    var fileSize = this.getResponseHeader("Content-Length");
                    document.getElementById(spanId).innerHTML = `<p>${formatBytes(fileSize)}</p>`;
                } else {
                    document.getElementById(spanId).innerHTML = `<p>(PDF - Not Found)</p>`;
                }
            }
        };
        xhr.send();
    }

    // Fungsi untuk mengubah ukuran file menjadi format yang lebih mudah dibaca
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Panggil fungsi untuk setiap tautan panduan
    @foreach($panduans as $panduan)
    getFileSize("{{ asset('file/' . $panduan->file) }}", "file_size_{{ urlencode($panduan->filename) }}");
    @endforeach

</script>
@endpush
