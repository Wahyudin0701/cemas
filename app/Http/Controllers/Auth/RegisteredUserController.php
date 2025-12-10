<?php

namespace App\Http\Controllers\Auth;

use App\Models\Toko;
use App\Models\User;
use App\Models\Pembeli;
use App\Models\Penjual;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Storage; // Wajib: Tambahkan untuk penanganan file KTP

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function createPembeli(): View
    {
        return view('auth.register-pembeli');
    }
    public function createPenjual(): View
    {
        return view('auth.register-penjual');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storePembeli(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'required|max:20',
            'alamat'   => 'required|max:255',
            'role'     => 'required|in:pembeli',
        ], [
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan email lain.',
            'email.required' => 'Email wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 6 karakter.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);


        // 1. SIMPAN USER
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
            'role'     => $validated['role'], // enum otomatis
        ]);

        // 2. SIMPAN DATA PEMBELI
        Pembeli::create([
            'user_id' => $user->id,
            'phone'   => $validated['phone'],
            'alamat'  => $validated['alamat'],
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Akun anda berhasil dibuat. Silakan login.');
    }

    public function storePenjual(Request $request)
    {
        $validated = $request->validate([
            // USER
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:penjual',

            // PENJUAL
            'nik'       => 'required|digits:16|unique:penjuals,nik',
            'foto_ktp'  => 'required|image|max:2048',
            'phone'     => 'required|max:20',
            'alamat'    => 'required|max:255',

            // TOKO
            'nama_toko'       => 'required|string|max:255',
            'deskripsi_toko'  => 'required|string',
            'foto_toko'       => 'required|image|max:2048',
            'jam_buka'        => 'required',
            'jam_tutup'       => 'required',
            'lokasi'          => 'required|string|max:255',
        ], [
            // Custom Error Message
            'email.unique' => 'Email sudah digunakan.',
            'nik.unique'   => 'NIK sudah terdaftar.',
            'nik.digits'   => 'NIK harus berjumlah 16 digit.',
            'foto_ktp.image' => 'Foto KTP harus berupa gambar.',
            'foto_toko.image' => 'Foto toko harus berupa gambar.',
        ]);

        // ================================
        // 1. UPLOAD FOTO KTP
        // ================================
        $fotoKtpPath = null;
        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('ktp', 'cloudinary');
            $fotoKtpPath = $path;
        }


        // ================================
        // 2. UPLOAD FOTO TOKO
        // ================================
        $fotoToko = null;
        if ($request->hasFile('foto_toko')) {
            $path = $request->file('foto_toko')->store('toko', 'cloudinary');
            $fotoTokoPath = $path;
        }


        // ================================
        // 3. SIMPAN USER
        // ================================
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
            'role'     => $validated['role'],
        ]);

        // ================================
        // 4. SIMPAN DATA PENJUAL
        // ================================
        $penjual = Penjual::create([
            'user_id'   => $user->id,
            'nik'       => $validated['nik'],
            'foto_ktp'  => $fotoKtpPath,
            'phone'     => $validated['phone'],
            'alamat'    => $validated['alamat'],
        ]);

        // ================================
        // 5. SIMPAN DATA TOKO
        // ================================
        Toko::create([
            'penjual_id'       => $penjual->id,
            'nama_toko'        => $validated['nama_toko'],
            'deskripsi_toko'   => $validated['deskripsi_toko'],
            'foto_toko'        => $fotoTokoPath,
            'jam_buka'         => $validated['jam_buka'],
            'jam_tutup'        => $validated['jam_tutup'],
            'lokasi'           => $validated['lokasi'],
            'status_verifikasi' => 'Menunggu',
        ]);

        event(new Registered($user));
        return redirect()->route('login')->with('success', 'Akun anda berhasil dibuat. Silakan login.');
    }
}
