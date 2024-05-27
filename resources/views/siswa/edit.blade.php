  {{-- @extends('layouts.template')

  @section('konten')
      <!-- START FORM -->
      <form action='{{ url('siswa/' . $data->namabarang) }}' method='post' enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="my-3 p-3 bg-body rounded shadow-sm">
              <div class="col-sm-5 mb-3"><a href="{{ url('siswa') }}" class="btn btn-secondary "><i
                          class="bi bi-arrow-left"></i></a></div>
              <div class="mb-3 row">
                  <label for="gambar" class="col-sm-2 col-form-label">Upload Gambar</label>
                  <div class="col-sm-10">
                      @if ($data->gambar)
                          <img src="{{ asset('storage/' . $data->gambar) }}" alt="Current Image"
                              style="max-width: 200px; margin-top: 10px;">
                      @endif
                      <input class="form-control" type="file" name="gambar" id="gambar">
                  </div>
              </div>
              <div class="mb-3 row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" name='namabarang' value="{{ $data->namabarang }}"
                          id="namabarang">
                  </div>
              </div>
              <div class="mb-3 row">
                  <label for="jurusan" class="col-sm-2 col-form-label">Deskripsi</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" name='deskripsi' value="{{ $data->deskripsi }}"
                          id="deskripsi">
                  </div>
              </div>
              <div class="mb-3 row">
                  <label for="jurusan" class="col-sm-2 col-form-label">Nomor HP</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" name='nomer' value="{{ $data->nomer }}" id="nomer">
                  </div>
              </div>
              <div class="mb-3 row">
                  <label for="jurusan" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-5"><button class="btn btn-primary" name="submit" type="submit">Kirim</button></div>
              </div>
          </div>
      </form>
      <!-- AKHIR FORM -->
  @endsection --}}

  @extends('layouts.template')

  @section('konten')
      <!-- START FORM -->
      <form action='{{ url('siswa/' . $data->namabarang) }}' method='post' enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="my-3 p-3 bg-body rounded shadow-sm">
              <div class="col-sm-5 mb-3"><a href="{{ url('dashboard') }}" class="btn btn-secondary "><i
                          class="bi bi-arrow-left"></i></a></div>
              <h2 class="fw-bold mb-5">Upload Barang Yang di Cari</h2>
              <div class="mb-3 row">
                  <div class="col-4">
                      <label for="gambar">
                          @if ($data->gambar)
                              <img src="{{ asset('storage/' . $data->gambar) }}" id="imagePreview"
                                  class="img-fluid object-fit-cover mx-auto mb-3" alt="Current Image" style="height: 300px;"
                                  width="300px">
                          @else
                              <img src="{{ asset('img/filegambar2.png') }}" id="imagePreview" class="img-fluid"
                                  alt="" class="img-fluid object-fit-cover mx-auto mb-3" alt=""
                                  style="height: 300px;" width="300px">
                          @endif
                      </label>
                      <input class="form-control d-none" type="file" name="gambar" id="gambar" accept="image/*">
                  </div>
                  <div class="row col-8">
                      <div class="col-12">
                          <label for="namabarang" class="col-sm-2 col-form-label fw-bold">Nama Barang :</label>
                          <input type="text" class="form-control " name='namabarang' value="{{ $data->namabarang }}"
                              id="namabarang">
                      </div>
                      <div class="col-12">
                          <label for="jurusan" class="col-form-label fw-bold">Deskripsi Barang :</label>
                          <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="5">{{ $data->deskripsi }}"</textarea>
                      </div>
                      <div class="col-12 d-flex align-items-center">
                          <input type="number" class="form-control me-5 fw-bold" name='nomer' value="{{ $data->nomer }}"
                              id="nomer" placeholder="+62">
                          <button class="btn bg-primary text-light fw-bold px-5" name="submit"
                              type="submit">Kirim</button>
                      </div>
                  </div>
              </div>


          </div>
      </form>
      <!-- AKHIR FORM -->
  @endsection
