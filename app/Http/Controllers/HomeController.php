<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // Ambil beberapa toko untuk preview di homepage jika masih butuh, atau kosongkan.
        // Jika user minta memindahkan ke halaman khusus, mungkin di homepage sudah tidak butuh list toko
        $tokoList = Toko::where('status_verifikasi', 'Terverifikasi')->take(3)->get();
        
        $produkList = \App\Models\Produk::whereHas('toko', function ($q) {
            $q->where('status_verifikasi', 'Terverifikasi');
        })->with('toko')->latest()->take(4)->get();

        $pesananAktif = collect();
        if (auth()->check() && auth()->user()->isPembeli() && auth()->user()->pembeli) {
            $pesananAktif = \App\Models\Pesanan::with('toko')
                ->where('pembeli_id', auth()->user()->pembeli->id)
                ->whereNotIn('status_pesanan', ['Selesai', 'Dibatalkan'])
                ->latest()
                ->get();
        }

        return view('homepage', compact('tokoList', 'produkList', 'pesananAktif'));
    }

    public function daftarToko()
    {
        $tokoList = Toko::where('status_verifikasi', 'Terverifikasi')->get();
        return view('daftar-toko', compact('tokoList'));
    }

    public function semuaProduk(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Produk::whereHas('toko', function ($q) {
            $q->where('status_verifikasi', 'Terverifikasi');
        })->with('toko');

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        $produks = $query->latest()->paginate(12);

        return view('produk', compact('produks'));
    }

    public function tentangCemas()
    {
        return view('tentang-cemas');
    }
}
