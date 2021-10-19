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
        .btn-lgn {
            background-color: #343a40;
            border-color: #12e343;
            color: #12e343;
            text-align: center;
            display: inline-block;
            cursor: pointer;
            border-radius: 6px;
            padding: 5px 40px;
        }

        .btn-rgs {
            background-color: #9ea3a9;
            border: none;
            color: #ffffff;
            text-align: center;
            display: inline-block;
            cursor: pointer;
            border-radius: 6px;
            padding: 5px 40px;
        }

    </style>
</head>

<body style="background-color: #343a40">
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/no_img.jpeg') }}" width="60" height="40" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link underline">Home</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link underline">Log
                                in</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link underline">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>
    
    {{-- CONTENT --}}
    <div class="">
        <div class="col text-center p-4" style="background-color: #343a40">
            <div class="col">
                <h1 style="color: #12e343">UP INDONESIA</h1>
                <h4 style="color: #8b949a">#MUDAHKANPERJALANANMU</h4>
                <p style="color: #f8f9fa">
                    PT DIGITAL TRANS MILENIAL atau DTM merupakan perusahaan platform digital yang saat ini sedang
                    mengembangkan
                    usahanya dalam bisnis transportasi online dan marketplace.</p>
            </div>

            <div class="col mt-4 mb-4">
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <button class="btn-lgn">Login</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn-rgs">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <img id="carousel-img-{{ $key }}" class="carousel-img" src="{{ asset('img/no_img.jpeg') }}"
                    alt="{{ $key }}">
        </div>
        @endforeach
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
                console.log(document.getElementById(img.id));
            }
        }
    </script>

    {{-- FOOTER --}}
    <div class="navbar navbar-dark bg-dark fixed-bottom" style="color: #ffffff">
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
</body>

</html>
