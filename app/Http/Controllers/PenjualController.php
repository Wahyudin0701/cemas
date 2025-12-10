<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualController extends Controller
{
    public function index()
    {
        // Ambil user login
        $user = Auth::user();

        $toko = $user->penjual->toko;

        // Ambil semua produk milik toko ini
        $produkList = $toko->produks()->get();

        // Hitung statistik
        $totalProduk = $produkList->count();

        return view('penjual.dashboard', compact('toko', 'produkList', 'totalProduk'));
    }

    public function cekStatus()
    {
        $penjual = Auth::user()->penjual;
        $toko = $penjual->toko;

        // Jika terverifikasi → ke dashboard
        if ($toko->status_verifikasi === 'Terverifikasi') {
            return redirect()->route('penjual.dashboard');
        }

        // Selain terverifikasi (Menunggu / Ditolak) → ke halaman waiting
        return redirect()->route('penjual.waiting-verification');
    }

    public function waitingVerification()
    {
        $user = Auth::user();

        // Jika user tidak punya data penjual
        if (!$user->penjual) {
            return redirect()->route('homepage')
                ->with('error', 'Anda tidak memiliki akses sebagai penjual.');
        }

        $penjual = $user->penjual;

        // Ambil toko berdasarkan penjual_id
        $toko = Toko::where('penjual_id', $penjual->id)->first();

        return view('penjual.waiting-verification', [
            'toko'     => $toko,
            'penjual'  => $penjual,
            'user'     => $user,
        ]);
    }
}
