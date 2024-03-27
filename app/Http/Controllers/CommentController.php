<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('comment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
    
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->save();
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}

