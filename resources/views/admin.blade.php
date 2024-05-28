<x-app-layout>
    <div class="container">
        <div class="my-3 p-5 bg-body rounded shadow-sm">
            <div class="col-sm-5 mb-3"><a href="{{ route('welcome') }}" class="btn btn-secondary "><i
                        class="bi bi-arrow-left"></i></a></div>
            <h1 class=" fw-bold pb-3">DASHBOARD ADMIN</h1>
            <!-- FORM PENCARIAN -->
            <div class="pb-3 ">
                <form class="d-flex" action="{{ url('siswa') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci"
                        value="{{ Request::get('katakunci') }}" placeholder="Cari barang" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </form>
            </div>

            <!-- TAMBAH DATA -->
            <div class="pb-3">
                <a href='{{ url('siswa/create') }}' class="btn btn-primary">Upload barang</a>
            </div>

            <!-- TABEL ITEM BELUM SELESAI -->
            <h2 class="pt-4 pb-3 fw-bold">Daftar Barang Pengguna</h2>
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th class="col-md-1">Nama</th>
                        <th class="col-md-2">Gambar</th>
                        <th class="col-md-1">Barang</th>
                        <th class="col-md-3">Deskripsi</th>
                        <th class="col-md-1">Nomer HP</th>
                        <th class="col-md-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count() > 0)
                        @foreach ($data as $item)
                            <tr class="{{ $item->statuspost == 0 ? 'table-dark' : '' }}">
                                <td class="text-center fw-bold">
                                    {{ $item->user->name }}
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                        class="img-fluid object-fit-cover mx-auto" alt="" style="height: 100px"
                                        width="100px">
                                </td>
                                <td>{{ $item->namabarang }}</td>
                                <td>{{ Str::limit($item->deskripsi, 120) }}
                                <td>{{ $item->nomer }}</td>
                                <td>
                                    <a href='{{ route('barang.detail', $item->id) }}' class="btn btn-primary"><i
                                            class="bi bi-eye"></i>Detail</a>
                                    @if ($item->statuspost == 0)
                                        <form onsubmit="return confirm('Yakin ingin mengubah status barang ini?')"
                                            class="d-inline" action="{{ route('barang.toggleSuspend', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" name="submit"
                                                class="btn btn-{{ $item->statuspost == 0 ? 'success' : 'warning' }} m-1">
                                                <i
                                                    class="bi bi-{{ $item->statuspost == 1 ? 'ban' : 'check-circle' }}"></i>
                                                {{ $item->statuspost == 0 ? 'Aktifkan' : 'Suspend' }}
                                            </button>
                                        </form>
                                    @else
                                        <form onsubmit="return confirm('Yakin ingin mengubah status barang ini?')"
                                            class="d-inline" action="{{ route('barang.toggleSuspend', $item->id) }}"
                                            method="POST">
                                            @csrf

                                            <button type="submit" name="submit"
                                                class="btn btn-{{ $item->statuspost == 0 ? 'success' : 'warning' }} m-1">
                                                <i
                                                    class="bi bi-{{ $item->statuspost == 1 ? 'ban' : 'check-circle' }}"></i>
                                                {{ $item->statuspost == 0 ? 'Aktifkan' : 'Suspend' }}
                                            </button>
                                        </form>
                                    @endif
                                    <form onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline"
                                        action="{{ url('siswa/' . $item->namabarang) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="submit" class="btn btn-danger"><i
                                                class="bi bi-trash"></i>Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="8">Barang tidak ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
