<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/mine.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        
        
    </head>
    <body class="font-sans antialiased ">
        <div class=" bg-gray-100 ">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
            @include('komponen.pesan')
                {{ $slot }}
            </main>

             {{-- Footer --}}
        <footer class="footer mt-auto py-3 bg-dark text-white pt-5 ">
            <div class="container">
              <div class="row">
                <div class="col-md-4 d-flex">
                    <img src="{{ asset('img/favicon.png') }}" alt="">
                    <div class="d-inline">
                        <a href="" class="btn btn-success fw-bold btn-lg rounded-pill">FINDER<span class="text-primary">Track</span></a>
                        <p>SMK N 1 BANGSRI</p>
                    </div>
                </div>
                <div class="col-md-2">
                  <h4 class="fw-bold">Menu Utama</h4>
                  <p>Beranda</p>
                  <p>Barang</p>
                  <p>Testi</p>
                </div>
                <div class="col-md-4">
                  <h4 class="fw-bold">Lokasi</h4>
                  <p>JL. KH. Achmad Fauzan No. 17 Bangsri Jepara. 
                     <br>Email : smkn1bangsri@yahoo.co.id</p>
                </div>
                <div class="col-md-2">
                  <h4 class="fw-bold">Follow Us</h4>
                    <a href="https://www.instagram.com/smkn1bangsri.official?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="blank"><i class="bi bi-instagram pe-4 fs-2"></i></a>
                    <a href="https://youtube.com/@SMKN1BANGSRI?si=LBBRig7_vjTnIS9E" target="blank"><i class="bi bi-youtube pe-3 fs-2 text-danger"></i></a>
                </div>
              </div>
            </div>
        </footer>
        </div>

        {{-- Love rating --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.like-button').forEach(button => {
                    button.addEventListener('click', function () {
                        const commentId = this.getAttribute('data-comment-id');
                        const likeCountSpan = this.querySelector('.like-count');
                        const heartIcon = this.querySelector('.bi-heart');
            
                        fetch(`/comments/${commentId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (response.status === 409) {
                                alert('You have already liked this comment.');
                                throw new Error('Already liked');
                            }
                            return response.json();
                        })
                        .then(data => {
                            likeCountSpan.textContent = data.likes;
                            heartIcon.classList.add('bi-heart-fill', 'text-danger');
                            heartIcon.classList.remove('bi-heart');
                        })
                        .catch(error => console.error('Error:', error));
                    });
                });
            });
            </script>

            {{-- Rating --}}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const stars = document.querySelectorAll('.star-rating .bi');
                    const ratingInput = document.getElementById('rating');

                    stars.forEach(star => {
                        star.addEventListener('click', function () {
                            const rating = this.getAttribute('data-rating');
                            ratingInput.value = rating;
                            updateStarRating(rating);
                        });
                        
                    });

                    function updateStarRating(rating) {
                        stars.forEach(star => {
                            if (star.getAttribute('data-rating') <= rating) {
                                star.classList.remove('bi-star');
                                star.classList.add('bi-star-fill');
                            } else {
                                star.classList.remove('bi-star-fill');
                                star.classList.add('bi-star');
                            }
                        });
                    }
                });
            </script>

    </body>
</html>
