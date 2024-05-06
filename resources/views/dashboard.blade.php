<x-app-layout>
    <div class="container">
        <div class="my-3 p-5 bg-body rounded shadow-sm">
            <!-- FORM PENCARIAN -->
            <div class="pb-3 pt-5">
                <form class="d-flex" action="{{ url('siswa') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari barang" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </form>
            </div>

            <!-- TAMBAH DATA -->
            <div class="pb-3">
                <a href='{{ url('siswa/create') }}' class="btn btn-primary">Upload barang</a>
            </div>

            <!-- TABEL ITEM BELUM SELESAI -->
            <h2 class="pt-5 pb-3 fw-bold">Barang yang dicari</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Gambar</th>
                        <th class="col-md-2">Nama Barang</th>
                        <th class="col-md-3">Deskripsi</th>
                        <th class="col-md-1">Nomer HP</th>
                        <th class="col-md-2">Tanggal</th>
                        <th class="col-md-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count() > 0)
                    @foreach ($data as $item)
                    @if ($item->status == 0)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/' . $item->gambar) }}" alt=""></td>
                        <td>{{ $item->namabarang }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->nomer }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href='{{ url('siswa/'.$item->namabarang. '/edit') }}' class="btn btn-warning btn-sm m-1"><i class="bi bi-pencil-square"></i>Edit</a>
                            <form onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline" action="{{ url('siswa/'.$item->namabarang) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm m-1"><i class="bi bi-trash"></i>Del</button>
                            </form>
                            <form class="d-inline" action="{{ route('ketemu', [$item->id]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" name="submit" class="btn btn-success btn-sm m-1"><i class="bi bi-check2-square"></i>Done</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="8">Barang tidak ditemukan</td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>

        <!-- TABEL ITEM SUDAH SELESAI -->
        <div class="my-3 mt-5 p-5 bg-body rounded shadow-sm">
            <h2 class=" pb-3 fw-bold">Sudah Ditemukan</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Gambar</th>
                        <th class="col-md-2">Nama Barang</th>
                        <th class="col-md-3">Deskripsi</th>
                        <th class="col-md-1">Nomer HP</th>
                        <th class="col-md-2">Tanggal</th>
                        <th class="col-md-1">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    @if ($item->status == 1)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/' . $item->gambar) }}" alt=""></td>
                        <td>{{ $item->namabarang }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->nomer }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>
                            <form class="d-inline" action="{{ route('batal', [$item->id]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm m-1"><i class="bi bi-x-square"></i>Batal</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>    
        {{-- link --}}
    </div>
</x-app-layout>
