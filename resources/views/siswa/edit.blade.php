  @extends('layouts.template')

@section('konten')
    
    <!-- START FORM -->
    <form action='{{ url('siswa/'.$data->namabarang) }}' method='post' enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="col-sm-5 mb-3"><a href="{{ url('siswa') }}" class="btn btn-secondary "><i class="bi bi-arrow-left"></i></a></div> 
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='namabarang' value="{{ $data->namabarang }}" id="namabarang">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Upload Gambar</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" name="gambar" id="gambar">

                {{-- <input type="text" class="form-control" name='gambar' value="{{ $data->gambar }}" id="gambar"> --}}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='deskripsi' value="{{ $data->deskripsi }}" id="deskripsi">
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

@endsection
