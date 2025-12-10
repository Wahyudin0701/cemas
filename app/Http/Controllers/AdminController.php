<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use App\Enums\UserRole;
use App\Models\Pembeli;
use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPengguna' => User::count() - User::where('role', 'admin')->count(),
            'totalPenjual'       => Penjual::count(),
            'tokoTerverifikasi'  => Toko::where('status_verifikasi', 'Terverifikasi')->count(),
            'tokoMenunggu'       => Toko::where('status_verifikasi', 'Menunggu')->count(),
            'tokoDitolak'       => Toko::where('status_verifikasi', 'Ditolak')->count(),
            'penjualPending'     => Toko::where('status_verifikasi', 'Menunggu')
                ->with('penjual.user')
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }

    public function semuaPengguna()
    {
        $pengguna = User::with(['penjual.toko', 'pembeli'])
            ->where('role', '!=', UserRole::Admin)   // exclude admin
            ->get();

        return view('admin.semua-pengguna', compact('pengguna'));
    }

    public function detailPengguna($id)
    {
        $user = User::with(['penjual.toko', 'pembeli'])->findOrFail($id);
        $penjual = $user->penjual;
        
        return view('admin.detail-pengguna', compact('user', 'penjual'));
    }

    public function updateStatusToko(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
        ]);

        $toko = Toko::findOrFail($id);

        // Jika action = approve
        if ($request->action === 'approve') {
            $toko->status_verifikasi = 'Terverifikasi';
            $toko->save();

            return back()->with('success', 'Toko berhasil diverifikasi.');
        }

        // Jika action = reject
        if ($request->action === 'reject') {
            $toko->status_verifikasi = 'Ditolak';
            $toko->save();

            return back()->with('success', 'Toko berhasil ditolak.');
        }
    }

    public function toggleStatusUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent disabling own account
        if ($user->id === Auth::user()->id) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return back()->with('success', "Akun pengguna {$user->name} berhasil {$status}.");
    }



    public function semuaToko(Request $request)
    {
        $query = Toko::with('penjual.user');

        // Search Filter (Shop Name or Seller Name)
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_toko', 'like', "%{$search}%")
                  ->orWhereHas('penjual.user', function($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Status Filter
        if ($request->has('status') && $request->status) {
            $query->where('status_verifikasi', $request->status);
        }

        $tokos = $query->get();

        return view('admin.semua-toko', compact('tokos'));
    }
}
