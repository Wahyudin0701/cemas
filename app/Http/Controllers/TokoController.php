<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    /**
     * Menampilkan halaman edit profil toko.
     */
    public function edit()
    {
        $user = Auth::user();

        // Pastikan user punya akses penjual dan toko
        if (!$user->penjual || !$user->penjual->toko) {
            return redirect()->route('home')->with('error', 'Toko tidak ditemukan.');
        }

        $penjual = $user->penjual;
        $toko = $penjual->toko;

        return view('penjual.toko', compact('toko', 'penjual'));
    }

    /**
     * Memperbarui profil toko.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->penjual || !$user->penjual->toko) {
            return redirect()->route('home')->with('error', 'Toko tidak ditemukan.');
        }

        $penjual = $user->penjual;
        $toko = $penjual->toko;

        // Validasi
        $validated = $request->validate([
            'nama_toko'       => 'required|string|max:255',
            'alamat'          => 'required|string|max:255',
            'kontak'          => 'required|string|max:20',
            'deskripsi'       => 'nullable|string',
            'foto_toko'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 1. Update data Penjual (Phone/Kontak)
        $penjual->update([
            'phone' => $validated['kontak'],
        ]);

        // 2. Handle Foto Toko
        $pathFoto = $toko->foto_toko; // Default pakai yang lama

        if ($request->hasFile('foto_toko')) {
            // Hapus foto lama jika ada (dan bukan URL external dummy)
            if ($toko->foto_toko && !str_starts_with($toko->foto_toko, 'http')) {
                Storage::disk('cloudinary')->delete($toko->foto_toko);
            }
            
            // Upload baru
            $pathFoto = $request->file('foto_toko')->store('toko', 'cloudinary');
        }

        // 3. Update data Toko
        $toko->update([
            'nama_toko'      => $validated['nama_toko'],
            'lokasi'         => $validated['alamat'],
            'deskripsi_toko' => $validated['deskripsi'],
            'foto_toko'      => $pathFoto,
        ]);

        return redirect()->route('penjual.toko')->with('success', 'Profil toko berhasil diperbarui.');
    }
}
