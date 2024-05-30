<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        $data = siswa::all();
        return view('admin', compact('data'));
    }

    public function toggleSuspend($id)
    {
        $barang = Siswa::findOrFail($id);
        // Toggle statuspost (0 untuk active, 1 untuk suspend)
        $barang->statuspost = !$barang->statuspost;
        $barang->save();

        if ($barang->statuspost == 1) {
            Session::put('suspended_post_id', $id);
        }

        return redirect()->back()->with('success', 'Status postingan berhasil diubah.');
    }
}
