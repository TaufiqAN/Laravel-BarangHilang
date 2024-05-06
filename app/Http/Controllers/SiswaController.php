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

        $jumlahbaris = 10;
        if(strlen($katakunci)){
            $data = siswa::where('namabarang','like',"%$katakunci%")
            // ->orWhere('deskripsi','like',"%$katakunci%")
            ->paginate($jumlahbaris);
        }else{
            $data = siswa::orderBy('namabarang', 'desc')->paginate($jumlahbaris);
        }
        return view('dashboard')->with('data', $data);

    }

    public function beranda(){
        $data = siswa::all();
        $comments = Comment::all();
        return view('welcome', compact('data', 'comments'));

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
        Session::flash('namabarang',$request->namabarang);
        Session::flash('deskripsi',$request->deskripsi);
        Session::flash('nomer',$request->nomer);

        $request->validate([
            'gambar'=>'nullable|mimes:png,jpg,jpeg',
            'namabarang'=>'required',
            'deskripsi'=>'required',
            'nomer'=>'required|numeric',
        ],[
            'namabarang.required'=> 'Nama Barang wajib diisi',
            'deskripsi.required'=> 'Deskripsi wajib diisi',
            'nomer.required'=> 'Nomer HP wajib diisi',
            'nomer.numeric'=> 'Nomer HP wajib dengan angka',
        ]);
        
        $data = [
            'namabarang'=>$request->namabarang,
            'deskripsi'=>$request->deskripsi,
            'nomer'=>$request->nomer,
            'status'=> 0,
        ];

        if($request->file('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('post-images');
        }
        siswa::create($data);
        return redirect()->to('siswa')->with('success', 'Berhasil di upload');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = siswa::where('namabarang',$id)->first();
        return view('siswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Session::flash('namabarang',$request->namabarang);
        Session::flash('gambar',$request->gambar);
        Session::flash('deskripsi',$request->deskripsi);
        Session::flash('nomer',$request->nomer);

        $request->validate([
            'namabarang'=>'required',
            'deskripsi'=>'required',
            'nomer'=>'required|numeric',
        ],[
            'namabarang.required'=> 'Nama Barang wajib diisi',
            'deskripsi.required'=> 'Deskripsi wajib diisi',
            'nomer.required'=> 'Nomer HP wajib diisi',
            'nomer.numeric'=> 'Nomer HP wajib dengan angka',
        ]);
        $data = [
            'namabarang'=>$request->namabarang,
            'gambar'=>$request->gambar,
            'deskripsi'=>$request->deskripsi,
            'nomer'=>$request->nomer,
        ];

        if($request->file('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('post-images');

        siswa::where('namabarang',$id)->update($data);
        return redirect()->to('siswa')->with('success', 'Berhasil di update');
    };
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
        siswa::where('namabarang',$id)->delete();
        return redirect()->to('siswa')->with('success', 'Berhasil di hapus');
    }
}
