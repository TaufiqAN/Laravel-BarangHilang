@extends('layouts.template')

        @section('konten')
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <div class="pb-3">
                  <form class="d-flex" action="{{ url('siswa') }}" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari barang" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div>
                
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3">
                  <a href='{{ url('siswa/create') }}' class="btn btn-primary">Upload barang</a>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-4">Gambar</th>
                            <th class="col-md-3">Nama Barang</th>
                            <th class="col-md-2">Deskripsi</th>
                            <th class="col-md-2">Nomer HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->gambar }}</td>
                            <td>{{ $item->namabarang }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->nomer }}</td>
                            <td>
                                <a href='{{ url('siswa/'.$item->namabarang. '/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline" action="{{ url('siswa/'.$item->namabarang) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               {{ $data->withQueryString()->links() }}
          </div>
          <!-- AKHIR DATA -->
        @endsection