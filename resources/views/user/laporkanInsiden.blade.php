<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Sistem Laporan Insiden</title>
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

    {{-- css global ours --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <style>
    body {
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        background-image: url('img/login_bg.svg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Open Sans', sans-serif !important;
        box-sizing: border-box;
        background-color: rgba(0, 0, 0, 0.3);
    }
    </style>

</head>

<body>
    <div>
        <a href="{{ url('/') }}">
            <img src="img/logo_login.svg" alt="Login Image" class="img-fluid"
                style="max-height: 100%; max-width: 100%;">
        </a>
        <div class="login-box">
            <div class="left-box">
                <div class="login-form">
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form id="loginForm" method="post" action="{{ url('/masuk') }}">
                        @csrf
                        <input type="text" name="email" id="email" class="form-control" placeholder="NIP" required style="padding: 10px; text-align: center;">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                            required style="padding: 10px;">
                        <!-- <ul id="passwordErrors" class="list-unstyled small text-danger"></ul> -->
                        <p style="font-size: 12px; color:#323232;padding:0; margin: 0">Jika lupa password hubungi admin
                            di csirt@ap1.co.id.</p>
                        <button type="submit" style="padding: 10px;"><b>Login</b></button>
                    </form>
                </div>
            </div>
            <div class="right-box">
                <!-- Tambahkan elemen untuk gambar -->
                <div class="col">
                    <h2 style="color: #0072B9;">SISTEM PELAPORAN INSIDEN</h2>
                    <img src="img/loginGambar.png" alt="Login Image" class="img-fluid"
                        style="max-height: 70%; max-width: 70%; display: block;
  margin-left: auto;
  margin-right: auto;">
                </div>
                <!-- Tambahkan tautan kembali ke beranda -->
                <a href="{{ route('user.beranda') }}" class="back-to-home btn">Kembali Ke Beranda</a>
            </div>
        </div>
    </div>
    <!-- <div class="footer">
        <div class="lowerFooter" >
            <p>© Copyright 2023 PT Angkasa Pura I</p>
        </div>
    </div> -->

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;

            var hasLength = password.length >= 8;
            var hasCapital = /[A-Z]/.test(password);
            var hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            var errorMessages = [];

            // Check for password criteria and build error messages
            if (!hasLength) {
                errorMessages.push('Password harus memiliki minimal 8 karakter.');
            }
            if (!hasCapital) {
                errorMessages.push('Password harus mengandung minimal satu huruf kapital.');
            }
            if (!hasSpecial) {
                errorMessages.push('Password harus mengandung minimal satu karakter khusus.');
            }

            // Display error messages in the passwordErrors list
            var passwordErrors = document.getElementById('passwordErrors');
            passwordErrors.innerHTML = ''; // Clear previous errors

            errorMessages.forEach(function(message) {
                var listItem = document.createElement('li');
                listItem.textContent = message;
                passwordErrors.appendChild(listItem);
            });

            // Prevent form submission if there are errors
            if (errorMessages.length > 0) {
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>

</body>

</html>
