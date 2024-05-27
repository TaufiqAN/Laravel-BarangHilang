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
        $request->validate([
            'komen' => 'required|string',
            // 'nama' => 'required',
            // 'kelas' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ],[
            'komen.required'=> 'Komentar wajib diisi',
            'rating.required'=> 'Rating wajib diisi',
            // 'nama.required'=> 'Deskripsi wajib diisi',
            // 'kelas.required'=> 'Nomer HP wajib diisi',
        ]);

        $user = auth()->user();

        $testi = new Comment();
        // $testi->user_id = auth()->user()->id;
        // $testi->nama = $request->nama;
        // $testi->kelas = $request->kelas;
        $testi->user_id = $user->id;
        $testi->nama = $user->name;
        $testi->kelas = $user->kelas;
        $testi->komen = $request->komen;
        $testi->rating = $request->rating;
        $testi->save();

        return Redirect::route('welcome')->with('success', 'Komentar berhasil ditambahkan.', 'komen');
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

