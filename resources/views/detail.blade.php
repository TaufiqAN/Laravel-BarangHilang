@extends('layouts.more ')

<section class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
      <div class="col">
          <h1 class="fw-bold">Saat ini di cari</h1>
          <p class="mb-5">Mungkin barangmu ada disini</p>
      </div>
    </div>
    {{-- barang --}}
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5 ">
      @foreach ($data as $item)
      <div class="col">
        <div class="card p-3 border border-dark border-1">
          <img src="{{ asset('img/tas.jpg') }}" class="card-img-top" alt="...">
          <div class="card-body">
              <h5 class="card-title fw-bold"><h3>{{ $item->namabarang }}</h3></h5>
              <p class="card-text">{{ $item->deskripsi }}</p>

              <div class="row">
                  <div class="col fw-bold text-success">
                    <p> <i class="bi bi-clock me-2"></i> {{ $item->created_at->diffForHumans() }}</p>
                  </div>
                </div>
          </div>
        </div>
      </div>
      @endforeach
  </div>
</section>