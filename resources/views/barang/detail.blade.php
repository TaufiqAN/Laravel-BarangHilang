@extends('layouts.more ')

<section class="container">
  <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
    <div class="col mb-6">
      <h1 class="fw-bold">Selengkapnya</h1>
    </div>
  </div>
  
    @if (Route::has('login'))
    @auth
    <div class="row mb-4">
      <div class="col-lg-1">
        <img src="{{ $data->user->photo ? asset('storage/' . $data->user->photo) : asset('img/default-avatar.png') }}" class="rounded-circle" alt="...">
      </div>
      <div class="col-lg-4 align-self-center">
        @if ($data->user)
          <h2 class="fs-5 fw-bold text-secondary">{{ $data->user->name }}</h2>
        @else
          <h2 class="fs-5 fw-bold text-secondary">Pengguna Tidak Diketahui</h2>
        @endif
          <h5 class="bg-success text-light w-25">{{ $data->user->kelas }}</h5>
      </div>
    </div>
    @endauth
    @endif

    {{-- barang --}}
    <div class="row ">
      <div class="col-lg-4">
          <img src="{{ asset('storage/' . $data->gambar) }}" class="img-fluid" alt="...">
      </div>
          <div class="col-lg-8 align-self-center">
              <h2 class="fw-bold"> Jenis Barang :{{ $data->namabarang }}</h2>
              <h5 class="border border-primary p-3">{{ $data->deskripsi }}</h5>
          </div>

          <div class="row">
            <div class="col">
                <a href='https://wa.me/083107933134' class="btn btn-outline-success fw-bold float-end">Chat Admin</a>
            </div>
          </div>

   </div>
</section>