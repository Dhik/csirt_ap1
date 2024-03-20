@extends('layout.userLayout')
@section('title', 'Hubungi Kami')
@section('content')

<div class="container hubungiKami">
    <h3>Hubungi Kami</h3>
    <hr style="margin-bottom: 30px">

    <div class="row hubungiKamiDesk">
        <div class="col-md-7">
            <div class="hubkiri">
                <!-- Menampilkan peta dari alamat yang diberikan -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8228916514086!2d106.83944407458866!3d-6.15446966032273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f590b2876d69%3A0x964f7a15848b8436!2sAngkasa%20Pura%20Airports!5e0!3m2!1sen!2sid!4v1700210171177!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></iframe>            
            </div>
        </div>
        <div class="col-md-5 hubKanan">
            <div class=" text-left">
                <img src="/img/logoHub.svg" alt="Logo" class="img-fluid" width="50%">

                <div class="alamat d-flex">
                    <i class="bi bi-geo-alt me-2" ></i>
                    <div>
                        <p class="mb-0">
                            Graha Angkasa Pura 1, 10, Jl. Kota Baru Bandar Kemayoran No.Kav 2, RW.10, Gn. Sahari Sel., Kec. Kemayoran, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10610
                            <br>
                        </p>
                    </div>
                </div>
                <div class="kontak d-flex align-items-center" style="padding-bottom: 30px">
                    <i class="bi bi-telephone me-2" style="font-size: 25px; padding-right: 20px"></i>
                    <p class="mb-0">(021) 6541961 ext.2161</p>
                </div>
                <a href="https://www.google.com/maps?q=-6.161345995508311,106.856018914533" target="_blank">Buka di Google Maps</a>

            </div>
        </div>
    </div>

    <div class="hubungiKamiMobile container">
        <div class=" text-left">
            <div class="img">
                <img src="/img/logoHub.svg" alt="Logo" class="img-fluid" width="50%">
            </div>

            <div class="hubAtas">
                <div class="alamat d-flex">
                    <i class="bi bi-geo-alt me-2" ></i>
                    <div>
                        <p class="mb-0">
                            Graha Angkasa Pura 1, 10, Jl. Kota Baru Bandar Kemayoran No.Kav 2, RW.10, Gn. Sahari Sel., Kec. Kemayoran, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10610
                            <br>
                        </p>
                    </div>
                </div>
                <div class="kontak d-flex align-items-center " style="padding-bottom: 30px">
                    <i class="bi bi-telephone me-2" ></i>
                    <div>
                        <p class="mb-0">(021) 6541961 ext.2161</p>
                    </div>
                </div>
            </div>
            <div class="hubkiri">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8228916514086!2d106.83944407458866!3d-6.15446966032273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f590b2876d69%3A0x964f7a15848b8436!2sAngkasa%20Pura%20Airports!5e0!3m2!1sen!2sid!4v1700210171177!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></iframe>            
            </div>
        </div>
    </div>
</div>

@endsection
