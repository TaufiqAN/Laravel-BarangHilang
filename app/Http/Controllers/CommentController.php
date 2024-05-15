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
        Session::flash('ranting',$request->ranting);

        $request->validate([
            'komen' => 'required|string',
            'nama' => 'required',
            'kelas' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ],[
            'komen.required'=> 'Nama Barang wajib diisi',
            'nama.required'=> 'Deskripsi wajib diisi',
            'kelas.required'=> 'Nomer HP wajib diisi',
            'rating.required'=> 'Nomer HP wajib diisi',
        ]);

        $testi = new Comment();
        $testi->nama = $request->nama;
        $testi->kelas = $request->kelas;
        $testi->komen = $request->komen;
        $testi->rating = $request->rating;
        $testi->save();
        return Redirect::route('welcome')->with('success', 'Comment added successfully.', 'komen');
    }

    public function like(Comment $comment)
        {
            $user = auth()->user();

            if ($comment->likes()->where('user_id', $user->id)->exists()) {
                return response()->json(['message' => 'Already liked'], 409);
            }

            $comment->likes()->attach($user->id);
            $comment->increment('likes');

            return response()->json(['likes' => $comment->likes, 'message' => 'Liked']);
        }

}

