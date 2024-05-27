<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        $jumlahbaris = 4;
        if (strlen($katakunci)) {
            $data = siswa::where('namabarang', 'like', "%$katakunci%")
                // ->orWhere('deskripsi','like',"%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = siswa::orderBy('namabarang', 'desc')->paginate($jumlahbaris);
        }
        return view('dashboard')->with('data', $data);
    }

    public function beranda(Request $request)
    {
        $lagiDicari = $request->lagiDicari;
        $sudahDitemukan = $request->sudahDitemukan;
        $jumlahbaris = 6;

        // Barang yang dicari
        if (strlen($lagiDicari)) {
            $barangDicari = siswa::where('namabarang', 'like', "%$lagiDicari%")
                ->where('status', 0)
                ->paginate($jumlahbaris, ['*'], 'barangDicariPage');
        } else {
            $barangDicari = siswa::where('status', 0)
                ->orderBy('namabarang', 'desc')
                ->paginate($jumlahbaris, ['*'], 'barangDicariPage');
        }

        // Barang yang sudah ditemukan
        if (strlen($sudahDitemukan)) {
            $barangDitemukan = siswa::where('namabarang', 'like', "%$sudahDitemukan%")
                ->where('status', 1)
                ->paginate($jumlahbaris, ['*'], 'barangDitemukanPage');
        } else {
            $barangDitemukan = siswa::where('status', 1)
                ->orderBy('namabarang', 'desc')
                ->paginate($jumlahbaris, ['*'], 'barangDitemukanPage');
        }

        $comments = Comment::with('user')->latest()->limit(4)->get();
        return view('welcome', compact('barangDicari', 'barangDitemukan', 'comments',));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    public function batal($id)
    {
        $data = siswa::findOrFail($id);

        if ($data) {
            $data->status = 0;
            $data->save();

            return redirect()->back()->with('success', 'Aksi "Batal" berhasil dilakukan.');
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('namabarang', $request->namabarang);
        Session::flash('deskripsi', $request->deskripsi);
        Session::flash('nomer', $request->nomer);

        $request->validate([
            'gambar' => 'nullable|mimes:png,jpg,jpeg',
            'namabarang' => 'required',
            'deskripsi' => 'required',
            'nomer' => 'required|numeric',
        ], [
            'namabarang.required' => 'Nama Barang wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'nomer.required' => 'Nomer HP wajib diisi',
            'nomer.numeric' => 'Nomer HP wajib dengan angka',
        ]);

        $data = [
            'namabarang' => $request->namabarang,
            'deskripsi' => $request->deskripsi,
            'nomer' => $request->nomer,
            'status' => 0,
            'user_id' => auth()->user()->id
        ];

        if ($request->file('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('post-images');
        }
        siswa::create($data);
        return redirect()->to('dashboard')->with('success', 'Berhasil di upload');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $siswa = Siswa::findOrFail($id);
        // return view('siswa.edit', compact('siswa'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = siswa::where('namabarang', $id)->first();
        return view('siswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Session::flash('namabarang', $request->namabarang);
        Session::flash('gambar', $request->gambar);
        Session::flash('deskripsi', $request->deskripsi);
        Session::flash('nomer', $request->nomer);

        $request->validate([
            'gambar' => 'nullable|mimes:png,jpg,jpeg',
            'namabarang' => 'required',
            'deskripsi' => 'required',
            'nomer' => 'required|numeric',
        ], [
            'namabarang.required' => 'Nama Barang wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'nomer.required' => 'Nomer HP wajib diisi',
            'nomer.numeric' => 'Nomer HP wajib dengan angka',
        ]);
        $data = [
            'namabarang' => $request->namabarang,
            'gambar' => $request->gambar,
            'deskripsi' => $request->deskripsi,
            'nomer' => $request->nomer,
        ];


        if ($request->file('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('post-images');
        }

        siswa::where('namabarang', $id)->update($data);
        return redirect()->to('dashboard')->with('success', 'Berhasil di update');
    }

    public function ketemu($id)
    {
        $data = siswa::findOrFail($id);
        $data->update(['status' => '1']);

        return redirect()->back()->with('HOREEE', 'Barang sudah ditemukan.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        siswa::where('namabarang', $id)->delete();
        return redirect()->to('siswa')->with('success', 'Berhasil di hapus');
    }
}
