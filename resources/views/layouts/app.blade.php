<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            {{-- <!-- Alert Suspend-->
            @if ($suspendedItems->count() > 0)
                <div class="modal fade" id="suspendModal" tabindex="-1" role="dialog"
                    aria-labelledby="suspendModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="suspendModalLabel">Peringatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Postingan Anda berikut telah disuspend:
                                <ul>
                                    @foreach ($suspendedItems as $item)
                                        <li>{{ $item->namabarang }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('markSuspendedAsSeen') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">OK</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#suspendModal').modal('show');
                    });
                </script>
            @endif --}}
        </main>

        {{-- Footer --}}
        <footer class="footer mt-auto py-3 text-white pt-5 footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex">
                        <img src="{{ asset('img/favicon.png') }}" class="img-fluid" style="max-height: 80px"
                            alt="">
                        <div class="d-inline">
                            <a href="" class="btn btn-success fw-bold btn-lg rounded-pill">FINDER<span
                                    class="text-primary">Track</span></a>
                            <p>SMK N 1 BANGSRI</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h4 class="fw-bold">Menu Utama</h4>
                        <p><a href="#1" class="link-footer">Beranda</a></p>
                        <p><a href="#2" class="link-footer">Barang</a></p>
                        <p><a href="#3" class="link-footer">Testi</a></p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="fw-bold">Lokasi</h4>
                        <p>JL. KH. Achmad Fauzan No. 17 Bangsri Jepara.
                            <br>Email : smkn1bangsri@yahoo.co.id
                        </p>
                    </div>
                    <div class="col-md-2">
                        <h4 class="fw-bold">Follow Us</h4>
                        <a href="https://www.instagram.com/smkn1bangsri.official?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                            target="blank"><i class="bi bi-instagram pe-4 fs-2"></i></a>
                        <a href="https://youtube.com/@SMKN1BANGSRI?si=LBBRig7_vjTnIS9E" target="blank"><i
                                class="bi bi-youtube pe-3 fs-2 text-danger"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    {{-- Love rating --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.like-button').forEach(button => {
                button.addEventListener('click', function() {
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
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating .bi');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('click', function() {
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
