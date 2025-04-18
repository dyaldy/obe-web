<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakultasfstController extends Controller
{
    public function sainsTeknologi()
    {
        // Ambil data program studi dari database jika diperlukan
        $prodi = [
            ['nama' => 'Informatika', 'jumlah' => 300],
            ['nama' => 'Sistem Informasi', 'jumlah' => 250],
            ['nama' => 'RPL', 'jumlah' => 200],
        ];

        return view('fakultasfst.sains_tek', compact('prodi'));
    }
}
