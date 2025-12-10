<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\DetailKeranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Method untuk helper ambil keranjang user current
    // Updated to accept optional toko_id
    private function getUserCart($tokoId = null)
    {
        $user = Auth::user();
        if (!$user || !$user->pembeli) return null;

        $query = Keranjang::where('pembeli_id', $user->pembeli->id);

        if ($tokoId) {
            $query->where('toko_id', $tokoId);
        }

        // Return collection if no tokoId specified (all carts), or single model if specified?
        // Let's standardise: this helper gets ONE specific cart if tokoId is present.
        if ($tokoId) {
            return $query->first();
        }
        
        // If getting all carts, we return the collection
        return $query->get();
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'integer|min:1'
        ]);

        $user = Auth::user();
        if (!$user || !$user->pembeli) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $produk = Produk::findOrFail($request->produk_id);
        
        // Validate that the product belongs to the current shop if toko_id is provided
        if ($request->has('toko_id')) {
            if ($produk->toko_id != $request->toko_id) {
                return response()->json(['message' => 'Produk tidak valid untuk toko ini'], 400);
            }
        }
        
        $tokoId = $produk->toko_id;

        // Cari Keranjang khusus untuk Toko ini
        $keranjang = Keranjang::firstOrCreate(
            [
                'pembeli_id' => $user->pembeli->id,
                'toko_id' => $tokoId
            ]
        );

        // Cek apakah produk sudah ada di detail keranjang ini
        $detail = DetailKeranjang::where('keranjang_id', $keranjang->id)
            ->where('produk_id', $produk->id)
            ->first();

        $qtyTambah = $request->quantity ?? 1;

        $currentQty = $detail ? $detail->jumlah_produk : 0;
        
        if (($currentQty + $qtyTambah) > $produk->stok) {
            return response()->json([
                'message' => 'Stok tidak mencukupi. Sisa stok: ' . $produk->stok
            ], 400);
        }

        if ($detail) {
            $detail->jumlah_produk += $qtyTambah;
            $detail->save();
        } else {
            DetailKeranjang::create([
                'keranjang_id' => $keranjang->id,
                'produk_id' => $produk->id,
                'jumlah_produk' => $qtyTambah
            ]);
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang toko ' . $produk->toko->nama_toko]);
    }

    public function getCartItems(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->pembeli) {
            return response()->json([]);
        }

        $query = DetailKeranjang::whereHas('keranjang', function($q) use ($user) {
            $q->where('pembeli_id', $user->pembeli->id);
        })->with(['produk']);

        // Filter by Toko if requested (for Side Drawer)
        if ($request->has('toko_id')) {
            $tokoId = $request->toko_id;
            $query->whereHas('keranjang', function($q) use ($tokoId) {
                $q->where('toko_id', $tokoId);
            });
        }

        $items = $query->get();

        return response()->json($items);
    }

    public function removeItem($produkId)
    {
        // Logic remains similar, but ensure we find the right detail
        // Ideally we pass detail_id, but current API passes produkId.
        // We must find the detail owned by this user via any of their carts.
        
        $user = Auth::user();
        if(!$user->pembeli) return response()->json(['error' => 'Unauthorized'], 403);

        $pembeliId = $user->pembeli->id;

        $deleted = DetailKeranjang::whereHas('keranjang', function($q) use ($pembeliId) {
            $q->where('pembeli_id', $pembeliId);
        })->where('produk_id', $produkId)->delete();

        if ($deleted) {
            return response()->json(['success' => true]);
        }
        
        return response()->json(['error' => 'Item not found'], 404);
    }

    public function index()
    {
        // Global Cart Page (showing all shops)
        $user = Auth::user();
        if (!$user || !$user->pembeli) return redirect('/');

        $allCarts = Keranjang::where('pembeli_id', $user->pembeli->id)->with('detailKeranjangs.produk.toko')->get();
        
        // Group items manually by shop from the carts
        $cartGroups = [];
        
        foreach($allCarts as $c) {
            if($c->detailKeranjangs->isNotEmpty() && $c->toko) {
                $cartGroups[] = [
                    'toko' => $c->toko,
                    'items' => $c->detailKeranjangs
                ];
            }
        }

        return view('pembeli.keranjang', [
            'cartGroups' => $cartGroups
        ]);
    }
    
    public function updateQty(Request $request)
    {
        $request->validate([
            'detail_id' => 'required|exists:detail_keranjangs,id',
            'change' => 'required|integer|in:1,-1'
        ]);

        $detail = DetailKeranjang::with(['produk', 'keranjang'])->findOrFail($request->detail_id);
        
        // Ensure user owns this cart item
        if ($detail->keranjang->pembeli_id !== Auth::user()->pembeli->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $newQty = $detail->jumlah_produk + $request->change;

        // Jika qty 0, hapus item
        if ($newQty <= 0) {
            $detail->delete();
            
            // Hitung ulang total toko
            $shopTotal = $this->calculateShopTotal($detail->keranjang_id);
            
            return response()->json([
                'status' => 'deleted',
                'shop_total' => $shopTotal,
                'shop_total_formatted' => number_format($shopTotal, 0, ',', '.')
            ]);
        }

        // Cek stok
        if ($newQty > $detail->produk->stok) {
            return response()->json([
                'error' => 'Stok tidak mencukupi (Max: ' . $detail->produk->stok . ')'
            ], 400);
        }

        $detail->jumlah_produk = $newQty;
        $detail->save();
        
        $shopTotal = $this->calculateShopTotal($detail->keranjang_id);

        return response()->json([
            'status' => 'updated',
            'new_qty' => $newQty,
            'shop_total' => $shopTotal,
            'shop_total_formatted' => number_format($shopTotal, 0, ',', '.')
        ]);
    }

    private function calculateShopTotal($keranjangId)
    {
        $items = DetailKeranjang::where('keranjang_id', $keranjangId)->with('produk')->get();
        $total = 0;
        foreach($items as $item) {
            $total += $item->jumlah_produk * $item->produk->harga;
        }
        return $total;
    }
}
