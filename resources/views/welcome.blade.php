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
                  <section class="hero">
                  <div class="container">
                    <div class="row flex-column-reverse flex-sm-row">
                      <div class="col align-self-center ">
                              <h1 class="fw-bold display-4">Selamat Datang di F<span class="text-primary">I</span>NDER</h1>
                              <p class="mb-5">Bertanyalah untuk mencari</p>
                              <a href="{{ route('register') }}"><button type="button" class="btn btn-primary btn-lg me-3">Get Started <i class="bi bi-arrow-right ms-2"></i></button></a>
                              <a href='{{ url('siswa/create') }}' class="btn btn-outline-primary btn-lg"><i class="bi bi-cloud-plus me-2"></i>Upload</a>
                            </div>
                            <div class="col-lg-6 mb-3">
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
                    <form class="d-flex " action="{{ url('siswa') }}" method="get">
                        <input class="form-control me-1 p-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari barang" aria-label="Search">
                        <button class="btn btn-success p-3" type="submit"><i class="bi bi-search"></i> </button>
                    </form>
                </div>
              </div>
              {{-- barang --}}
              <div class="row row-cols-1 row-cols-md-3 g-4 mb-5 ">
                @foreach ($data as $item)
                <div class="col">
                  <div class="card p-3 border border-dark border-1">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><h3>{{ $item->namabarang }}</h3></h5>
                        <p class="card-text">{{ $item->deskripsi }}</p>
    
                        <div class="row">
                            <div class="col fw-bold text-success">
                              <p> <i class="bi bi-clock me-2"></i> {{ $item->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="col">
                                <a href='{{ url('siswa/'.$item->namabarang. '/edit') }}' class="btn btn-outline-dark fw-bold btn-sm float-end">Selengkapnya</a>
                            </div>
                             <a href="{{ route('detail.show', ['id' => $item->namabarang]) }}">Lihat Data Diri</a>
                          </div>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
          </section>

          {{-- Testimoni --}}
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
                      <h5 class="card-title fw-bold">{{ $comment->nama }}</</h5>
                      <p class="fs-6 text-black-50">{{ $comment->kelas }}</</p>
                      <p class="card-text fs-6">{{ $comment->komen }}</p>
                    </div>
                  </div>
                </div>
                @endforeach
              </section>
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
                      <label for="exampleFormControlInput1" class="form-label">Nama</label>
                      <input name="nama" type="text" class="form-control p-3 border border-dark border-1" id="Nama" value="{{ Session::get('nama') }}" placeholder="Masukkan Nama">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Kelas</label>
                      <input name="kelas" type="text" class="form-control p-3 border border-dark border-1" id="Kelas" value="{{ Session::get('kelas') }}" placeholder="Masukkan Kelas">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label  for="exampleFormControlTextarea1" class="form-label">Komentar</label>
                      <textarea name="komen" class="form-control border border-dark border-1" id="komentar" rows="5" value="{{ Session::get('komen') }}" placeholder="Berikan Komentar"></textarea>
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
