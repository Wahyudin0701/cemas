<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->pembeli) {
            return redirect()->back()->with('error', 'Anda bukan pembeli.');
        }

        // Validate that we are checking out a specific shop
        $request->validate([
            'toko_id' => 'required|exists:tokos,id'
        ]);
        
        $tokoId = $request->toko_id;

        // Find the specific cart for this shop
        $keranjang = Keranjang::where('pembeli_id', $user->pembeli->id)
            ->where('toko_id', $tokoId)
            ->first();

        if (!$keranjang) {
             return redirect()->back()->with('error', 'Keranjang toko ini kosong.');
        }

        $cartItems = $keranjang->detailKeranjangs()->with('produk')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        try {
            DB::beginTransaction();

            $totalHarga = 0;
            foreach ($cartItems as $item) {
                $totalHarga += $item->jumlah_produk * $item->produk->harga;
            }

            // Create Pesanan
            $pesanan = Pesanan::create([
                'pembeli_id' => $user->pembeli->id,
                'toko_id' => $tokoId, // Explicitly this shop
                'tanggal_pesanan' => Carbon::now(),
                'status_pesanan' => 'Menunggu Konfirmasi', // Matches DB Enum
                'metode_pengambilan' => $request->metode_pengambilan ?? 'Diantar Penjual',
                'total_harga_final' => $totalHarga,
                'catatan_pembeli' => $request->catatan_pembeli ?? 'Checkout via Web'
            ]);

            // Create Details & Decrement Stock
            foreach ($cartItems as $item) {
                if ($item->produk->stok < $item->jumlah_produk) {
                    throw new \Exception("Stok produk {$item->produk->nama_produk} tidak mencukupi.");
                }

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'toko_id' => $tokoId,
                    'produk_id' => $item->produk_id,
                    'kuantitas' => $item->jumlah_produk,
                    'harga_saat_pesan' => $item->produk->harga,
                ]);

                $item->produk->decrement('stok', $item->jumlah_produk);
            }

            // Empty this specific cart
            $keranjang->detailKeranjangs()->delete();
            // Optional: Delete the cart itself if empty? Or keep it for future. Keeping it is fine.
            
            DB::commit();

            return redirect()->route('riwayat-pesanan')->with('success', 'Pesanan untuk toko ini berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
