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

        $jumlahbaris = 2;
        if(strlen($katakunci)){
            $data = siswa::where('namabarang','like',"%$katakunci%")
            ->orWhere('deskripsi','like',"%$katakunci%")
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('namabarang',$request->namabarang);
        Session::flash('gambar',$request->gambar);
        Session::flash('deskripsi',$request->deskripsi);
        Session::flash('nomer',$request->nomer);

        // $request->gambar->store('images', 'public');

        $request->validate([
            'gambar'=>'nullable|mimes:png,jpg,jpeg|max:2048',
            'namabarang'=>'required',
            'deskripsi'=>'required',
            'nomer'=>'required|numeric',
        ],[
            'namabarang.required'=> 'Nama Barang wajib diisi',
            'deskripsi.required'=> 'Deskripsi wajib diisi',
            'nomer.required'=> 'Nomer HP wajib diisi',
            'nomer.numeric'=> 'Nomer HP wajib dengan angka',
        ]);
        // $gambar = $request->file('gambar');
        // $filegambar = time().'.'.$gambar;
        // $request->gambar->move(public_path('images'), $filegambar);

        // $data = new siswa();
        // $data->save();
        $data = [
            'namabarang'=>$request->namabarang,
            // 'gambar'=>$filegambar,
            'deskripsi'=>$request->deskripsi,
            'nomer'=>$request->nomer,
        ];
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
        siswa::where('namabarang',$id)->update($data);
        return redirect()->to('siswa')->with('success', 'Berhasil di update');
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
