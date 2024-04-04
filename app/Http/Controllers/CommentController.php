<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        Session::flash('nama',$request->nama);
        Session::flash('kelas',$request->kelas);
        Session::flash('komen',$request->komen);
        // Session::flash('ranting',$request->ranting);

        $request->validate([
            'komen' => 'required|string',
            'nama' => 'required',
            'kelas' => 'required',
        ],[
            'komen.required'=> 'Nama Barang wajib diisi',
            'nama.required'=> 'Deskripsi wajib diisi',
            'kelas.required'=> 'Nomer HP wajib diisi',
        ]);

        $testi = new Comment();
        $testi->nama = $request->nama;
        $testi->kelas = $request->kelas;
        $testi->komen = $request->komen;
        $testi->save();
        return Redirect::route('welcome')->with('success', 'Comment added successfully.', 'komen');
    }
}

