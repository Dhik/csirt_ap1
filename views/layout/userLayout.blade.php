<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin')</title>
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- css global ours --}}
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    
</head>

<body>
   <!-- Navbar Start -->
   <nav class="navbar navbar-expand-xl bg-light navbar-light fixed-top navbarBG">
    <div class="navbar-logo">
        <img src="{{ asset('/img/logo.svg') }}" class="navImg" alt="logo">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars TogglerIcon" style="color: white;"></i>
        </span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link fiturMenu fitur{{ $berandaActive ?? '' }}" href="{{ route('user.beranda')}}"><p>BERANDA</p></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link fiturMenu fitur{{ $tentangKamiActive ?? '' }}" href="#" id="tentangKamiDropdown">
                    <p>TENTANG KAMI</p>
                </a>
                <div class="dropdown-content" id="tentangKamiDropdownContent">
                    <a class="dropdown-item fiturMenu" href="{{ route('profil')}}">Profil</a>
                    <a class="dropdown-item fiturMenu" href="{{ route('visiMisi')}}">Visi Misi</a>
                    <a class="dropdown-item fiturMenu" href="{{ route('struktur')}}">Struktur Organisasi</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link fiturMenu fitur{{ $rfcActive ?? '' }}" href="{{ route('user.rfc')}}"><p>RFC 2350</p></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link fiturMenu fitur{{ $layananActive ?? '' }}" href="#" id="layananDropdown">
                    <p>LAYANAN</p>
                </a>
                <div class="dropdown-content" id="layananDropdownContent">
                    <a class="dropdown-item fiturMenu" href="{{ route('aduanSiber')}}">Aduan Siber</a>
                    <a class="dropdown-item fiturMenu" href="{{ route('layananVA')}}">Layanan VA</a>
                    <a class="dropdown-item fiturMenu" href="{{ route('panduan')}}">Panduan Teknis</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link fiturMenu fitur{{ $eventActive ?? '' }}" href="{{ route('user.event')}}"><p>EVENT</p></a>
            </li>
            <li class="nav-item">
                <a class="nav-link fiturMenu fitur{{ $hubungiKamiActive ?? '' }}" href="{{ route('user.hubungiKami')}}"><p>HUBUNGI KAMI</p></a>
            </li>
            <li class="nav-item">
                <a class="nav-link fiturMenu fitur{{ $laporkanInsidenActive ?? '' }}" href="{{ route('user.laporkanInsiden')}}"><p>LAPORKAN INSIDEN</p></a>
            </li>
        </ul>
    </div>
</nav>

<!-- Navbar End -->


{{-- content --}}
<div class="bg">
    @yield('content')
</div>

<!-- Footer Start -->
<div class="footer footerDesk">
    <div class="highFooter">
        <div class="satu">
            <h6>TENTANG KAMI</h6>
            <a href="{{ route('profil')}}">Profil</a>
            <a href="{{ route('visiMisi')}}">Visi Misi</a>
            <a href="{{ route('struktur')}}">Struktur Organisasi</a>
            <div class="social">
                <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-facebook"></i></a>
                <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-instagram"></i></a>
                <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-twitter"></i></a>
                <a href="#" style="color: white; text-decoration: none; font-size: 20px;" ><i class="icon fab fa-youtube"></i></a>
            </div>
        </div>

        <div class="dua">
            <h6>LAYANAN</h6>
            <a href="{{ route('aduanSiber')}}">Aduan Siber</a>
            <a href="{{ route('layananVA')}}">Layanan VA</a>
            <a href="{{ route('panduan')}}">Panduan Teknis</a>
        </div>

        

        <div class="tiga">
            <img src="/img/foot_logo.svg" alt="Logo" >
            <h6>PT Angkasa Pura I</h6>
            <p style="padding: 0;margin: 0;">Kota Baru Bandar Kemayoran Blok B12 Kav.2 Jakarta Pusat, DKI Jakarta - Indonesia</p>
            <p style="padding: 0;margin: 0;">Telp. +62-21 6541961</p>
            <p style="padding: 0;margin: 0;">Faks. +62-21 6541514</p>
        </div>

        <div class="empat">
            <!-- Contact Center 172 -->
            <div class="contactFoot">
                <img src="/img/call_foot.svg" alt="Call Footer">
                <div>
                    <p style="margin: 0; ">Contact Center 172</p>
                </div>
            </div>

            <!-- Informasi, Saran dan Keluhan -->
            <div class="infoFoot">
                <img src="/img/write_foot.svg" alt="Write Footer">
                <div>
                    <p style="margin: 0;">Informasi, Saran dan Keluhan: cc172@ap1.co.id </p>
                </div>
            </div>
        </div>
    </div>
    <div class="lowerFooter" >
        <p>© Copyright 2023 PT Angkasa Pura I</p>
    </div>
</div>

<div class="footer footerTab">
    <div class="highFooter">
        <img src="/img/foot_logo.svg" alt="Logo" >
        <h6 class="footerPT">PT Angkasa Pura I</h6>
        <p style="padding: 0;margin: 0;">Kota Baru Bandar Kemayoran Blok B12 Kav.2 </p>
        <p style="padding: 0;margin: 0;">Jakarta Pusat, DKI Jakarta - Indonesia</p>
        <p style="padding: 0;margin: 0;">Telp. +62-21 6541961</p>
        <p style="padding: 0;margin: 0;">Faks. +62-21 6541514</p>
        <div class="social">
            <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-facebook"></i></a>
            <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-instagram"></i></a>
            <a href="#" style="color: white; text-decoration: none; margin-right: 10px; font-size: 20px;" ><i class="icon fab fa-twitter"></i></a>
            <a href="#" style="color: white; text-decoration: none; font-size: 20px;" ><i class="icon fab fa-youtube"></i></a>
        </div>
        <div class="TLFooterTab">
            <div class="tentang">
                <h6>TENTANG KAMI</h6>
                <a href="{{ route('profil')}}"><p>Profil</p></a>
                <a href="{{ route('visiMisi')}}"><p>Visi Misi</p></a>
                <a href="{{ route('struktur')}}"><p>Struktur Organisasi</p></a>
            </div>
            <div class="layanan">
                <h6>LAYANAN</h6>
                <a href="{{ route('aduanSiber')}}"><p>Aduan Siber</p></a>
                <a href="{{ route('layananVA')}}"><p>Layanan VA</p></a>
                <a href="{{ route('panduan')}}"><p>Panduan Teknis</p></a>
            </div>
            
        </div>
    </div>
    <div class="hotline">
        <div class="contactFoot">
            <img src="/img/call_foot.svg" alt="Call Footer">
            <div class="hotlineFooter">
                <p style="margin: 0; padding: 0">Contact Center </p>
                <p style="margin: 0; padding: 0">172</p>
            </div>
        </div>

        <div class="infoFoot">
            <img src="/img/write_foot.svg" alt="Write Footer">
            <div class="hotlineFooter">
                <p style="margin: 0; padding: 0">Informasi, Saran dan Keluhan:  </p>
                <p style="margin: 0; padding: 0">cc172@ap1.co.id</p>
            </div>
        </div>
    </div>
    <div class="lowerFooter" >
        <p>© Copyright 2023 PT Angkasa Pura I</p>
    </div>
</div>
<!-- Footer End -->



    @stack('scripts')
    <!-- JavaScript Libraries -->
    <!-- Bootstrap JavaScript and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function() {
            var dropdownContent = this.querySelector('.dropdown-content');
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            } else {
                // Hide all dropdown contents before showing the clicked one
                dropdowns.forEach(function(dropdown) {
                    dropdown.querySelector('.dropdown-content').style.display = 'none';
                });
                dropdownContent.style.display = 'block';
            }
        });
    });

    // Close dropdown when clicking outside
    window.addEventListener('click', function(event) {
        dropdowns.forEach(function(dropdown) {
            if (!dropdown.contains(event.target)) {
                dropdown.querySelector('.dropdown-content').style.display = 'none';
            }
        });
    });
});

    </script>
</body>

</html>