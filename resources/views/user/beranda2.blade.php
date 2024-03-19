@extends('layout.userLayout')
@section('title','CSIRT | Beranda')
@section('content')
        
    <div class="main-wrapper">
        <div class="galery-head container-fluid position-relative">
            <img src="/img/galeryHead.svg" class="w-100" alt="Heading">
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
