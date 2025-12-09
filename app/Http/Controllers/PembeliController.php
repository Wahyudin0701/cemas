<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class PembeliController extends Controller
{

    public function daftarToko()
    {
        // Ambil semua toko yang sudah terverifikasi
        $tokoList = Toko::where('status_verifikasi', 'Terverifikasi')->get();

        return view('pembeli.dashboard', compact('tokoList'));
    }

    public function lihatToko($id)
    {
        // Ambil toko + relasi penjual + user pemilik toko
        $toko = Toko::with(['penjual.user', 'produks'])->findOrFail($id);
        return view('pembeli.lihat-toko', compact('toko'));
    }
}
