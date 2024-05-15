<x-app-layout>
      
      {{-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-white bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Daftar</a>
                        @endif
                    @endauth
                  </div>
                  @endif
                </div> --}}
                  <div class="bg-primary bg-opacity-10">
                  <section class="hero mt-5 mb-5">
                  <div class="container">
                    <div class="row flex-column-reverse flex-sm-row">
                      <div class="col-lg-4 align-self-center ">
                              <h1 class="fw-bold display-4">Selamat <br> Datang di <br> Finder<span class="text-primary">Track</span></h1>
                              <p class="mb-5">Bertanyalah untuk mencari</p>
                              @guest
                              <a href="{{ route('register') }}"><button type="button" class="btn btn-primary btn-lg me-3">Get Started <i class="bi bi-arrow-right ms-2"></i></button></a>
                              @endguest
                              @auth
                              <a href='{{ url('siswa/create') }}' class="btn btn-outline-primary btn-lg"><i class="bi bi-cloud-plus me-2"></i>Upload</a>
                              @endauth
                            </div>
                            <div class="col-lg-8 mb-3">
                              <img src="{{ asset('img/hero.png') }}" alt="" class="img-fluid">
                            </div>
                          </div>
                        </div>
                      </section>
                  </div>
                    
                    

        {{-- Barang yang dicari --}}
        <section class="container">
              <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
                <div class="col">
                    <h1 class="fw-bold">Saat ini di cari</h1>
                    <p class="mb-5">Mungkin barangmu ada disini</p>
                </div>
                <div class="col">
                    <form class="d-flex " action="{{ route('welcome') }}" method="get">
                        <input class="form-control me-1 p-2 border border-dark border-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari barang" aria-label="Search">
                        <button class="btn btn-success p-3" type="submit"><i class="bi bi-search"></i> </button>
                    </form>
                </div>
              </div>
              {{-- barang --}}
              <div class="row row-cols-1 row-cols-md-3 g-4 mb-5 ">
                @foreach ($data as $item)
                @if ($item->status == 0)
                <div class="col">
                  <div class="card p-3 border border-dark border-1">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top object-fit-cover" style="height: 300px;" alt="...">
                    <div class="card-body">
                      
                      @if (Route::has('login'))
                        @auth
                            <div class="row mb-4">
                                <div class="col-lg-3">
                                    <img src="{{ asset('img/miaw.jpg') }}" class="rounded-circle" alt="...">
                                </div>
                                <div class="col-lg-8 align-self-center">
                                  @if ($item->user)
                                  <h2 class="fs-5 fw-bold text-secondary">{{ $item->user->name }}</h2>
                                    @else
                                  <h2 class="fs-5 fw-bold text-secondary">Pengguna Tidak Diketahui</h2>
                                   @endif
                                    <h5 class="bg-success text-light w-20 fs-6"> X PPLG 10</h5>
                                </div>
                            </div>
                        @else
                        @endauth
                      @endif

                        <p class="card-text">
                          {{ Str::limit($item->deskripsi, 120) }}
                          </p>
    
                        <div class="row">
                            <div class="col fw-bold text-success">
                              <p> <i class="bi bi-clock me-2"></i> {{ $item->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="col">
                                <a href='{{ route('barang.detail', $item->id) }}' class="btn btn-outline-dark fw-bold btn-sm float-end">Selengkapnya</a>
                            </div>

                          </div>
                    </div>
                  </div>
                </div>
                {{-- @else
                <h1 class="text-center">Tidak ada barang yang hilang.</> --}}
                @endif
                @endforeach
            </div>
          </section>

          {{-- Sudah ditemukan --}}
          <div class="bg-primary bg-opacity-10 pb-5">
            <section class="container">
              <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
                <div class="col">
                  <h1 class="fw-bold mb-5">Barang Yang sudah <br> ketemu</h1>
                </div>
                <div class="col">
                  <form class="d-flex " action="{{ route('welcome') }}" method="get">
                        <input class="form-control me-1 p-2 border border-dark border-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari barang" aria-label="Search">
                        <button class="btn btn-success p-3" type="submit"><i class="bi bi-search"></i> </button>
                  </form>
                </div>
              </div>
            {{-- barang sudah ditemukan--}}
            @if($data->count() > 0)
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            @foreach ($data as $item)
            @if ($item->status == 1)
            <div class="col">
              <div class="card p-3 border border-dark border-1">

                @if (Route::has('login'))
                  @auth
                      <div class="row mb-4">
                          <div class="col-lg-3">
                              <img src="{{ asset('img/miaw.jpg') }}" class="rounded-circle img-fluid" alt="...">
                          </div>
                          <div class="col-lg-4 align-self-center">
                            @if ($item->user)
                            <h2 class="fs-5 fw-bold text-secondary">{{ $item->user->name }}</h2>
                            @else
                            <h2 class="fs-5 fw-bold text-secondary">Pengguna Tidak Diketahui</h2>
                            @endif
                              <h5 class="bg-success text-light w-20 fs-6"> X PPLG 1</h5>
                          </div>
                      </div>
                  @else
                  @endauth
                @endif

                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><h2>{{ $item->namabarang }}</h2></h5>
                        <div class="row">
                          <div class="col fw-bold text-success">
                            <p> <i class="bi bi-clock me-2"></i> {{ $item->created_at->diffForHumans() }}</p>
                          </div>
                          <div class="col">
                              <a href='{{ route('welcome', $item->id) }}' class="btn btn-success btn-lg float-end">Ratting</a>
                          </div>
                        </div>
                    </div>
              </div>
            </div>
            @endif
            @endforeach
            </div> 
            @endif
            </section>
            </div>
                            
                            {{-- Testimoni --}}
          <div class="">
            <div class="pb-5">
              <section class="container">
                <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
                  <div class="col">
                    <h1 class="fw-bold">Testimoni</h1>
                    <p class="mb-5">Pendapat orang yang telah menemukan barangya kembali</p>
                  </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4 ">
                  @foreach ($comments as $comment)
                  <div class="col">
                    <div class="card shadow">
                      <div class="card-body">

                        <div class="row mb-3">
                          <div class="col-lg-2">
                            <img src="{{ asset('img/miaw.jpg') }}" class="rounded-circle img-fluid" alt="...">
                          </div>
                          <div class="col-lg-8">
                            <div class="text-warning">
                              @for ($i = 0; $i < $comment->rating; $i++)
                                  <i class="bi bi-star-fill"></i>
                              @endfor
                              @for ($i = $comment->rating; $i < 5; $i++)
                                  <i class="bi bi-star"></i>
                              @endfor
                            </div>
                            <h5 class="card-title fw-bold">{{ $comment->nama }}</</h5>
                            <p class="fs-6 text-black-50">{{ $comment->kelas }}</</p>
                          </div>
                          <div class="col-lg-2">
                            <div class="like-section">
                              @auth
                                  <button class="btn btn-outline-danger btn-sm like-button d-flex align-items-center" data-comment-id="{{ $comment->id }}">
                                      <i class="bi bi-heart{{ auth()->user()->likedComments->contains($comment->id) ? '-fill text-danger' : '' }} me-2"></i>
                                      <span class="like-count">{{ $comment->likes }}</span>
                                  </button>
                              @else
                                  <button class="btn btn-outline-danger btn-sm d-flex align-items-center" disabled>
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
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label fs-2">Nama</label>
                      <input name="nama" type="text" class="form-control p-3 border border-dark border-1" id="Nama" placeholder="Masukkan Nama">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label fs-2">Kelas</label>
                      <input name="kelas" type="text" class="form-control p-3 border border-dark border-1" id="Kelas" placeholder="Masukkan Kelas">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label  for="exampleFormControlTextarea1" class="form-label fs-2">Komentar</label>
                      <textarea name="komen" class="form-control border border-dark border-1" id="komentar" rows="5" placeholder="Berikan Komentar"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
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
                </div>
                <div class="d-grid gap-2 col-6 mx-auto pb-5 pt-5">
                  <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
            </section>
          </div>

          
        
 </x-app-layout>
