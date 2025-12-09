<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // Ambil semua toko yang sudah terverifikasi
        $tokoList = Toko::where('status_verifikasi', 'Terverifikasi')->get();

        return view('homepage', compact('tokoList'));
    }
}
