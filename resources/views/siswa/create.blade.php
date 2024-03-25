  @extends('layouts.template')

@section('konten')
    
    <!-- START FORM -->
    <form action='{{ url('siswa') }}' method='post' enctype="multipart/form-data">
        @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='namabarang' value="{{ Session::get('namabarang') }}" id="namabarang">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="image" class="col-sm-2 col-form-label">Upload Gambar</label>
            <div class="col-sm-10   ">
                <input class="form-control" type="file" name="gambar" id="gambar">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='deskripsi' value="{{ Session::get('deskripsi') }}" id="deskripsi">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Nomor HP</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nomer' value="{{ Session::get('nomer') }}" id="nomer">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit" type="submit">Kirim</button></div>
            <div class="col-sm-10"><a href="{{ url('siswa') }}" class="btn btn-secondary">Kembali</a></div>
        </div>
    </div>
    </form>
    <!-- AKHIR FORM -->

@endsection
