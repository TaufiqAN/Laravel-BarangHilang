  @extends('layouts.template')

  @section('konten')
      <!-- START FORM -->
      <form action='{{ url('dashboard') }}' method='post' enctype="multipart/form-data">
          @csrf
          <div class="my-3 p-3 bg-body rounded shadow-sm">
              <div class="col-sm-5 mb-3"><a href="{{ url('dashboard') }}" class="btn btn-secondary "><i
                          class="bi bi-arrow-left"></i></a></div>
              <h2 class="fw-bold mb-5">Upload Barang Yang di Cari</h2>
              <div class="mb-3 row">
                  <div class="col-4">
                      <label for="gambar">
                          <img src="{{ asset('img/filegambar2.png') }}" id="imagePreview" class="img-fluid" alt=""
                              class="img-fluid object-fit-cover mx-auto mb-3" alt="" style="height: 300px;"
                              width="300px">
                      </label>
                      <input class="form-control d-none" type="file" name="gambar" id="gambar" accept="image/*">
                  </div>
                  <div class="row col-8">
                      <div class="col-12">
                          <label for="namabarang" class="col-sm-2 col-form-label fw-bold">Nama Barang :</label>
                          <input type="text" class="form-control " name='namabarang'
                              value="{{ Session::get('namabarang') }}" id="namabarang">
                      </div>
                      <div class="col-12">
                          <label for="jurusan" class="col-form-label fw-bold">Deskripsi Barang :</label>
                          <textarea type="text" class="form-control" name='deskripsi' value="{{ Session::get('deskripsi') }}" rows="5"
                              id="deskripsi"></textarea>
                      </div>
                      <div class="col-12 d-flex align-items-center">
                          <input type="number" class="form-control me-5 fw-bold" name='nomer'
                              value="{{ Session::get('nomer') }}" id="nomer" placeholder="+62">
                          <button class="btn bg-primary text-light fw-bold px-5" name="submit"
                              type="submit">Kirim</button>
                      </div>
                  </div>
              </div>


          </div>
      </form>
      <!-- AKHIR FORM -->
  @endsection
