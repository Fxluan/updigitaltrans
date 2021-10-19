<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Digital Trans Milenial</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        @media (min-width: 768px) {
            .abs-center-x {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
        }

    </style>
</head>

<body class="">
    <div class="cointainer-fluid">

        {{-- NAVBAR --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/no_img.jpeg') }}" width="60" height="40" class="d-inline-block align-top"
                    alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav abs-center-x">
                    <li class="nav-item">
                        <a class="nav-link" href="/mitradriver">Mitra Driver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mitramerchant">Mitra Merchant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kontakkami">Kontak Kami</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link underline">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/user') }}" class="nav-link underline">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                @php($logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout'))
                                @if (config('adminlte.use_route_url', false))
                                    @php($logout_url = $logout_url ? route($logout_url) : '')
                                @else
                                    @php($logout_url = $logout_url ? url($logout_url) : '')
                                @endif
                                <a class="nav-link underline" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                                    @if (config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>

        {{-- HEADER --}}
        <div class="col text-center p-4" style="background-color: #f8f9fa">
            <div class="col">
                <h1 style="color: #12e343">UP INDONESIA</h1>
                <h4 style="color: #8b949a">#MUDAHKANPERJALANANMU</h4>
            </div>
        </div>

        {{-- CAROUSEL --}}
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <?php
            $img_carousel = ['no_img.jpeg', 'no_img.jpeg', 'no_img.jpeg'];
            ?>
            <div class="carousel-inner">
                @foreach ($img_carousel as $key => $val_img_carousel)
                    @if ($key == 0)
                        <div class="carousel-item active">
                    @endif
                    @if ($key != 0)
                        <div class="carousel-item">
                    @endif
                    <img id="carousel-img-{{ $key }}" class="carousel-img"
                        src="{{ asset('img/no_img.jpeg') }}" alt="{{ $key }}">
            </div>
            @endforeach
            <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <script>
        setupImageCarousel();

        function setupImageCarousel() {
            var x = screen.width;
            let y = document.getElementsByClassName("carousel-item");
            let z = y.length;

            for (let i = 0; i < z; i++) {
                const e = y[i];
                let img = e.children[0];

                document.getElementById(img.id).height = x * 0.328;
                document.getElementById(img.id).width = x;
            }
        }
    </script>

    {{-- CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    <div class="navbar navbar-dark bg-dark" style="color: #ffffff">
        <div class="col-sm-7">
            <div class="row">

                <div class="mr-1">
                    <p>Our Customers :</p>
                </div>
                <div class="">
                    <img src="{{ asset('img/no_img.jpeg') }}" width="60" height="40" class="d-inline-block align-top"
                        alt="">
                </div>
            </div>
        </div>
        <div class="col-sm-3 text-right">
            <p>copyright by Digital Trans Milenial 2020.</p>
        </div>
        <div class="col-sm-2 text-right">
            <a class="social-media-icon mr-3" href="https://link_social_mendia_anda"><span class="fab fa-youtube fa-lg"
                    style="color: rgb(128, 128, 128)"></span></a>
            <a class="social-media-icon mr-3" href="https://link_social_mendia_anda"><span
                    class="fab fa-instagram fa-lg" style="color: rgb(128, 128, 128)"></span></a>
            <a class="social-media-icon mr-3" href="https://link_social_mendia_anda"><span class="fab fa-facebook fa-lg"
                    style="color: rgb(128, 128, 128)"></span></a>
            <a class="social-media-icon mr-3" href="https://link_social_mendia_anda"><span class="fab fa-twitter fa-lg"
                    style="color: rgb(128, 128, 128)"></span></a>
        </div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    @include('sweetalert::alert')
</body>

</html>
