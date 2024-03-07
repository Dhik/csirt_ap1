@foreach ($carousels as $key => $carousel)
    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
        <img src="{{ asset('storage/' . $carousel->image_path) }}" class="d-block w-100" alt="carousel">
        
        @if (!empty($carousel->heading_caption) || !empty($carousel->caption))
            <div class="overlay-text">
                <div class="text-container px-md-5 px-lg-5">
                    @if (!empty($carousel->heading_caption))
                        <h1 class="text-black">{{ $carousel->heading_caption }}</h1>
                    @endif
                    @if (!empty($carousel->caption))
                        <p class="text-black">{{ $carousel->caption }}</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endforeach