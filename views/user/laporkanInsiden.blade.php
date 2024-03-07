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
            margin: 0;
            padding-top: 0;
            font-family: 'Open Sans', sans-serif !important;
            box-sizing: border-box;
        }
    </style>
    
</head>
<body>
    <div class="loginContainerDesk">
        <img src="img/logo_login.svg" alt="Login Image" class="img-fluid logoLogin" style="max-height: 100%; max-width: 100%;">
        <div class="container container-fluid">
            <div class="login-box">
                <div class="left-box">
                    <div class="title-box">
                        <h2 style="margin: 0;padding: 0">LOGIN SISTEM LAPORKAN INSIDEN</h2>
                    </div>
                    <div class="login-form">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form id="loginForm" method="post"action="{{ url('/masuk') }}" >
                            @csrf
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <p style="font-size: 12px; color:#323232;padding:0; margin: 0">Jika lupa password hubungi admin di admin@ap1.co.id.</p>
                            <button type="submit">Login</button>
                        </form>
                    </div>
                </div>
                <div class="right-box">
                    <img src="img/loginGambar.svg" alt="Login Image" class="img-fluid" style="max-height: 100%; max-width: 100%;">
                    <a href="{{ route('user.beranda') }}" class="back-to-home">Kembali Ke Beranda</a>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="lowerFooter" >
                <p>© Copyright 2023 PT Angkasa Pura I</p>
            </div>
        </div>
    </div>
    <div class="loginContainerMobile">
        <img src="img/logo_login.svg" alt="Login Image" class="img-fluid logoLogin" style="max-height: 100%; max-width: 100%;">
        <div class="container container-fluid">
            <div class="login-box">
                <div class="left-box">
                    <div class="title-box">
                        <h2 style="margin: 0;padding: 0">LOGIN SISTEM LAPORKAN INSIDEN</h2>
                    </div>
                    <img src="img/loginGambar.svg" alt="Login Image" class="logoForm img-fluid" style="max-height: 100%; max-width: 100%;">

                    <div class="login-form">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form id="loginForm" method="post"action="{{ url('/masuk') }}" >
                            @csrf
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <p style="font-size: 12px; color:#323232;padding:0; margin: 0">Jika lupa password hubungi admin di admin@ap1.co.id.</p>
                            <button type="submit">Login</button>
                        </form>
                    </div>
                    <a href="{{ route('user.beranda') }}" class="back-to-home">Kembali Ke Beranda</a>
     
                </div>
                
            </div>
        </div>
        <div class="footer">
            <div class="lowerFooter" >
                <p>© Copyright 2023 PT Angkasa Pura I</p>
            </div>
        </div>
    </div>
</body>
</html>
