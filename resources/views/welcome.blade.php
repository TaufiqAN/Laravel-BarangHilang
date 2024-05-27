<x-app-layout>
    <div class="bg-primary bg-opacity-10">
        <section class="hero mb-5">
            <div class="container">
                <div class="row flex-column-reverse flex-sm-row">
                    <div class="col-lg-4 align-self-center text-center text-lg-start">
                        <h1 class="fw-bold display-4">Selamat <br> Datang di <br> Finder<span
                                class="text-primary">Track</span></h1>
                        <p class="mb-5">Bertanyalah untuk mencari</p>
                        @guest
                            <a href="{{ route('register') }}">
                                <button type="button" class="btn btn-primary btn-lg me-3">Get Started <i
                                        class="bi bi-arrow-right ms-2"></i></button>
                            </a>
                        @endguest
                        @auth
                            <a href='{{ url('siswa/create') }}' class="btn btn-outline-primary btn-lg"><i
                                    class="bi bi-cloud-plus me-2"></i>Upload</a>
                        @endauth
                    </div>
                    <div class="col-lg-8 mb-3">
                        <img src="{{ asset('img/hero.png') }}" alt="Hero Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Barang yang dicari --}}
    <section class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
            <div class="col-6">
                <h1 class="fw-bold">Saat ini di cari</h1>
                <p class="mb-5">Mungkin barangmu ada disini</p>
            </div>
            <div class="col-6">
                <form class="d-flex" action="{{ route('welcome') }}" method="get">
                    <input class="form-control me-1 border border-dark border-1" type="search" name="lagiDicari"
                        value="{{ Request::get('lagiDicari') }}" placeholder="Cari barang" aria-label="Search">
                    <button class="btn btn-success py-3" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
        {{-- Barang yang dicari --}}
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            @foreach ($barangDicari as $item)
                @if ($item->status == 0 && $item->statuspost == 1)
                    <div class="col">
                        <div class="card p-3 border border-dark border-1">
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top object-fit-cover"
                                style="height: 300px;" alt="...">
                            <div class="card-body">

                                @if (Route::has('login'))
                                    @auth
                                        <div class="row mb-4">
                                            <div class="col-lg-3 col-sm-3 col-3">
                                                <img src="{{ $item->user->photo ? asset('storage/' . $item->user->photo) : asset('img/default-avatar.png') }}"
                                                    class="rounded-circle img-fluid" alt="Profile">
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 align-self-center">
                                                @if ($item->user)
                                                    <h2 class="fs-5 fw-bold text-secondary">{{ $item->user->name }}</h2>
                                                @else
                                                    <h2 class="fs-5 fw-bold text-secondary">Pengguna Tidak Diketahui</h2>
                                                @endif

                                                @if ($item->user && $item->user->kelas)
                                                    <h5 class="bg-success text-light w-20 fs-6">{{ $item->user->kelas }}
                                                    </h5>
                                                @endif
                                            </div>
                                        </div>
                                    @endauth
                                @endif
                                <h3 class="card-title fw-bold">{{ $item->namabarang }}</h3>
                                <p class="card-text">
                                    {{ Str::limit($item->deskripsi, 120) }}
                                </p>

                                <div class="row">
                                    <div class="col fw-bold text-success">
                                        <p><i class="bi bi-clock me-2"></i> {{ $item->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="col">
                                        <a href='{{ route('barang.detail', $item->id) }}'
                                            class="btn btn-outline-dark fw-bold btn-sm float-end">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{-- Tautan Paginasi --}}
        <div class="d-flex justify-content-center">
            {{ $barangDicari->links() }}
        </div>
    </section>
    </div>

    {{-- Sudah ditemukan --}}
    <div class="bg-primary bg-opacity-10 pb-5">
        <section class="container">
            <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
                <div class="col-6">
                    <h1 class="fw-bold mb-5">Barang Yang sudah <br> ketemu</h1>
                </div>
                <div class="col-6">
                    <form class="d-flex" action="{{ route('welcome') }}" method="get">
                        <input class="form-control me-1 p-2 border border-dark border-1" type="search"
                            name="sudahDitemukan" value="{{ Request::get('sudahDitemukan') }}"
                            placeholder="Cari barang" aria-label="Search">
                        <button class="btn btn-success p-3" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

            {{-- Barang yang sudah ditemukan --}}
            @if ($barangDitemukan->count() > 0)
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    @foreach ($barangDitemukan as $item)
                        @if ($item->status == 1 && $item->statuspost == 1)
                            <div class="col">
                                <div class="card p-3 border border-dark border-1">
                                    @if (Route::has('login'))
                                        @auth
                                            <div class="row mb-4">
                                                <div class="col-lg-3 col-sm-3 col-3">
                                                    <img src="{{ $item->user->photo ? asset('storage/' . $item->user->photo) : asset('img/default-avatar.png') }}"
                                                        class="rounded-circle img-fluid" alt="Profile">
                                                </div>
                                                <div class="col-lg-8 col-sm-8 col-8 align-self-center">
                                                    @if ($item->user)
                                                        <h2 class="fs-5 fw-bold text-secondary">{{ $item->user->name }}
                                                        </h2>
                                                    @else
                                                        <h2 class="fs-5 fw-bold text-secondary">Pengguna Tidak Diketahui
                                                        </h2>
                                                    @endif

                                                    @if ($item->user && $item->user->kelas)
                                                        <h5 class="bg-success text-light w-20 fs-6">
                                                            {{ $item->user->kelas }}
                                                        </h5>
                                                    @endif
                                                </div>
                                            </div>
                                        @endauth
                                    @endif
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                        class="card-img-top object-fit-cover" style="height: 300px;" alt="...">
                                    <div class="card-body">
                                        <h1 class="card-title fw-bold">{{ $item->namabarang }}</h1>
                                        <div class="row">
                                            <div class="col fw-bold text-success">
                                                <p><i class="bi bi-clock me-2"></i>
                                                    {{ $item->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="col">
                                                <a href='#122' class="btn btn-success btn-lg float-end">Rating</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            {{-- Tautan Paginasi --}}
            <div class="d-flex justify-content-center">
                {{ $barangDitemukan->links() }}
            </div>
        </section>
    </div>




    {{-- Testimoni --}}
    <div class="">
        <div class="pb-5">
            <section class="container">
                <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
                    <div class="col">
                        <h1 class="fw-bold">Testimoni</h1>
                        <p class="mb-5">Pendapat orang yang telah menemukan barangnya kembali</p>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($comments as $comment)
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-lg-2 col-2 col-sm-2">
                                            <img src="{{ $comment->user->photo ? asset('storage/' . $comment->user->photo) : asset('img/default-avatar.png') }}"
                                                class="rounded-circle img-fluid" alt="...">
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-8">
                                            <div class="text-warning">
                                                @for ($i = 0; $i < $comment->rating; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                                @for ($i = $comment->rating; $i < 5; $i++)
                                                    <i class="bi bi-star"></i>
                                                @endfor
                                            </div>
                                            {{-- <h5 class="card-title fw-bold">{{ $comment->nama }}</h5>
                                          <p class="fs-6 text-black-50">{{ $comment->kelas }}</p> --}}
                                            @if ($comment->user)
                                                <h5 class="fs-5 card-title fw-bold">{{ $comment->user->name }}</h5>
                                                <p class="fs-6 text-black-50">{{ $comment->user->kelas }}</p>
                                            @endif
                                        </div>
                                        <div class="col-lg-2 col-sm-2 col-2 text-center">
                                            <div class="like-section">
                                                @auth
                                                    <button
                                                        class="btn btn-outline-danger btn-sm like-button d-flex align-items-center justify-content-center"
                                                        data-comment-id="{{ $comment->id }}">
                                                        <i
                                                            class="bi bi-heart{{ auth()->user()->likedComments->contains($comment->id)? '-fill text-danger': '' }} me-2"></i>
                                                        <span class="like-count">{{ $comment->likes }}</span>
                                                    </button>
                                                @else
                                                    <button
                                                        class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center"
                                                        disabled>
                                                        <i class="bi bi-heart me-2"></i>
                                                        <span class="like-count">{{ $comment->likes }}</span>
                                                    </button>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                    <p class="card-text fs-6 mb-4">{{ $comment->komen }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    {{-- Komentar --}}
    <div class="bg-primary bg-opacity-10" id="122">
        <section class="container">
            <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
                <div class="col">
                    <h1 class="fw-bold">Komentar</h1>
                    <p class="mb-5">Berikan komentar setelah menggunakan website ini</p>
                </div>
            </div>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="komen" class="form-label fs-2">Komentar</label>
                        <textarea name="komen" class="form-control border border-dark border-1" id="komen" rows="5"
                            placeholder="Berikan Komentar"></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="rating" class="form-label fs-2">Rating</label>
                        <br>
                        <div class="star-rating">
                            <input type="hidden" name="rating" id="rating" value="0">
                            <i class="bi bi-star" data-rating="1"></i>
                            <i class="bi bi-star" data-rating="2"></i>
                            <i class="bi bi-star" data-rating="3"></i>
                            <i class="bi bi-star" data-rating="4"></i>
                            <i class="bi bi-star" data-rating="5"></i>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto pb-5 pt-5">
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
