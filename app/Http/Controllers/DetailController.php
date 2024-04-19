<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show($id)
    {
        $data = siswa::findOrFail($id);
        return view('barang.detail', compact('data'));
    }
}
