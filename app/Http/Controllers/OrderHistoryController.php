<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Pastikan user adalah pembeli
        if (!$user->pembeli) {
            abort(403, 'Akses ditolak');
        }

        $pesanan = Pesanan::where('pembeli_id', $user->pembeli->id)
            ->with(['toko', 'detailPesanans.produk'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pembeli.riwayat-pesanan', [
            'orders' => $pesanan
        ]);
    }

    public function show($id)
    {
        $order = Pesanan::with(['toko', 'detailPesanans.produk'])
            ->where('pembeli_id', Auth::user()->pembeli->id)
            ->findOrFail($id);
            
        return view('pembeli.detail-pesanan', [
            'order' => $order
        ]);
    }
}
