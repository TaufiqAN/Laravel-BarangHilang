<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

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

        // Toggle statuspost (1 untuk active, 0 untuk suspend)
        $barang->statuspost = !$barang->statuspost;
        $barang->save();

        return redirect()->back()->with('success', 'Status postingan berhasil diubah.');
    }
}
