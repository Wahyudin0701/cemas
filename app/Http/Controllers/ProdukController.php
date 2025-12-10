<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $toko = $user->penjual->toko;
        $produk = $toko->produks()->where('id', $id)->firstOrFail();

        return view('penjual.produk.index', compact('produk', 'toko'));
    }


    // Form tambah produk
    public function tambahProduk()
    {
        return view('penjual.produk.tambah');
    }

    public function storeProduk(Request $request)
    {
        $user = Auth::user();
        $toko = $user->penjual->toko;

        // Validasi dasar
        $validated = $request->validate([
            'nama_produk'   => ['required', 'string', 'max:255'],
            'harga'         => ['required', 'numeric', 'min:0'],
            'stok'          => ['required', 'integer', 'min:0'],
            'deskripsi'     => ['required', 'string'],
            'foto_produk'   => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Upload foto
        $pathFoto = null;
        if ($request->hasFile('foto_produk')) {
            $filename = time() . '-' . uniqid() . '.' . $request->foto_produk->extension();
            $request->foto_produk->move(public_path('Image/produk'), $filename);
            $pathFoto = 'Image/produk/' . $filename;
        }

        Produk::create([
            'toko_id'      => $toko->id,
            'nama_produk'  => $validated['nama_produk'],
            'deskripsi'    => $validated['deskripsi'],
            'harga'        => $validated['harga'],
            'stok'         => $validated['stok'],
            'foto_produk'  => $pathFoto,
        ]);

        return redirect()->route('penjual.dashboard')->with('success', 'Produk berhasil ditambahkan.');
    }


    // Form edit produk
    public function edit($id)
    {
        $produk = Produk::where('id', $id)
                        ->where('toko_id', Auth::user()->penjual->toko->id)
                        ->firstOrFail();

        return view('penjual.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::where('id', $id)
                        ->where('toko_id', Auth::user()->penjual->toko->id)
                        ->firstOrFail();

        // Validasi dasar
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Update foto jika ada
        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk && file_exists(public_path($produk->foto_produk))) {
                unlink(public_path($produk->foto_produk));
            }

            $filename = time() . '-' . uniqid() . '.' . $request->foto_produk->extension();
            $request->foto_produk->move(public_path('Image/produk'), $filename);
            $validated['foto_produk'] = 'Image/produk/' . $filename;
        }

        $produk->update($validated);

        return redirect()->route('penjual.dashboard')->with('success', 'Produk berhasil diperbarui!');
    }


    // Hapus produk
    public function destroy($id)
    {
        $user = Auth::user();
        $toko = $user->penjual->toko;

        $produk = $toko->produks()->where('id', $id)->firstOrFail();

        if ($produk->foto_produk && file_exists(public_path($produk->foto_produk))) {
            unlink(public_path($produk->foto_produk));
        }

        $produk->delete();

        return redirect()->route('penjual.dashboard')->with('success', 'Produk berhasil dihapus.');
    }
}
