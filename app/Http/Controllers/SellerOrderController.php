<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class SellerOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pastikan user punya toko
        if (!$user->penjual || !$user->penjual->toko) {
            return redirect()->route('penjual.dashboard')->with('error', 'Anda belum memiliki toko aktif.');
        }

        $orders = Pesanan::where('toko_id', $user->penjual->toko->id)
            ->with(['pembeli.user', 'detailPesanans.produk'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penjual.pesanan', [
            'orders' => $orders
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Pesanan::findOrFail($id);
        
        // Security check: ensure order belongs to seller's shop
        if ($order->toko_id !== Auth::user()->penjual->toko->id) {
            abort(403);
        }

        $currentStatus = $order->status_pesanan;
        $nextStatus = null;

        if ($currentStatus == 'Menunggu Konfirmasi') {
            $nextStatus = 'Dikonfirmasi/Diproses';
        } elseif ($currentStatus == 'Dikonfirmasi/Diproses') {
            $nextStatus = 'Siap Diambil/Diantar';
        } elseif ($currentStatus == 'Siap Diambil/Diantar') {
            $nextStatus = 'Selesai';
        }

        if ($nextStatus) {
            $order->status_pesanan = $nextStatus;
            $order->save();
            return back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . $nextStatus);
        }

        return back()->with('error', 'Pesanan tidak dapat diperbarui dari status saat ini.');
    }

    public function cancelOrder(Request $request, $id)
    {
        $order = Pesanan::findOrFail($id);
        
        // Security check: ensure order belongs to seller's shop
        if ($order->toko_id !== Auth::user()->penjual->toko->id) {
            abort(403);
        }

        $allowedStatuses = ['Menunggu Konfirmasi', 'Dikonfirmasi/Diproses'];

        if (in_array($order->status_pesanan, $allowedStatuses)) {
            $order->status_pesanan = 'Dibatalkan';
            $order->save();
            return back()->with('success', 'Pesanan berhasil dibatalkan.');
        }

        return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah diproses lanjut atau selesai.');
    }
}
