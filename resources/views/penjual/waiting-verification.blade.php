<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Verifikasi - CeMas</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .fade { opacity: 0; transform: translateY(12px); transition: .6s cubic-bezier(0.4, 0, 0.2, 1); }
        .fade.show { opacity: 1; transform: translateY(0); }
        .dot { animation: blink 1.4s infinite both; }
        .dot:nth-child(2) { animation-delay: .2s; }
        .dot:nth-child(3) { animation-delay: .4s; }
        @keyframes blink { 0%, 100% { opacity: .2; transform: scale(0.8); } 50% { opacity: 1; transform: scale(1.2); } }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a', 950: '#172554',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-slate-50 via-slate-100 to-slate-200 flex items-center justify-center min-h-screen relative overflow-hidden">

    <!-- Decorative animated blobs -->
    <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-blue-300/40 mix-blend-multiply rounded-full blur-3xl animate-blob opacity-70"></div>
    <div class="absolute top-[-10%] right-[-10%] w-[40rem] h-[40rem] bg-indigo-300/40 mix-blend-multiply rounded-full blur-3xl animate-blob animation-delay-2000 opacity-70"></div>
    <div class="absolute bottom-[-20%] left-[20%] w-[40rem] h-[40rem] bg-sky-300/40 mix-blend-multiply rounded-full blur-3xl animate-blob animation-delay-4000 opacity-70"></div>

    <!-- MAIN CONTENT -->
    <div class="max-w-xl w-full mx-auto px-6 py-12 relative z-10 fade">

        <div class="bg-white/80 backdrop-blur-xl shadow-xl shadow-slate-200/50 rounded-3xl p-10 md:p-12 border border-slate-100 text-center">

            <!-- Icon -->
            <div class="mb-8 relative inline-block">
                <!-- Outer pulse ring for pending -->
                @if($toko->status_verifikasi !== 'Terverifikasi' && $toko->status_verifikasi !== 'Ditolak')
                    <div class="absolute inset-0 bg-primary-100 rounded-full animate-ping opacity-75 scale-125"></div>
                @endif
                
                <div class="relative w-24 h-24 mx-auto rounded-full flex items-center justify-center shadow-inner z-10 
                    @if($toko->status_verifikasi === 'Terverifikasi') bg-emerald-50 text-emerald-600 border-4 border-emerald-100
                    @elseif($toko->status_verifikasi === 'Ditolak') bg-rose-50 text-rose-600 border-4 border-rose-100
                    @else bg-primary-50 text-primary-600 border-4 border-primary-100 @endif">

                    @if($toko->status_verifikasi === 'Terverifikasi')
                        <!-- ICON TERVERIFIKASI -->
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($toko->status_verifikasi === 'Ditolak')
                        <!-- ICON DITOLAK -->
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @else
                        <!-- ICON MENUNGGU -->
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @endif
                </div>
            </div>

            <!-- JUDUL & PESAN -->
            @if($toko->status_verifikasi === 'Terverifikasi')
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Toko Diverifikasi!</h2>
                <p class="text-slate-500 mt-3 font-medium text-lg leading-relaxed">
                    Selamat! Anda sudah dapat mengakses seluruh fitur dashboard penjual.
                </p>
            @elseif($toko->status_verifikasi === 'Ditolak')
                <h2 class="text-3xl font-extrabold text-rose-600 tracking-tight">Verifikasi Ditolak</h2>
                <p class="text-slate-500 mt-3 font-medium text-lg leading-relaxed">
                    Pengajuan Anda ditolak. Silakan periksa kembali data yang diunggah.
                </p>
            @else
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Menunggu Verifikasi</h2>
                <p class="text-slate-500 mt-3 font-medium text-lg leading-relaxed">
                    Pendaftaran toko Anda sedang ditinjau.
                </p>
                <!-- Loading dots -->
                <div class="flex justify-center items-center mt-5 gap-1.5 text-primary-500">
                    <span class="dot text-2xl leading-none">&bull;</span>
                    <span class="dot text-2xl leading-none">&bull;</span>
                    <span class="dot text-2xl leading-none">&bull;</span>
                </div>
            @endif

            <!-- INFO BOX -->
            <div class="bg-slate-50/80 rounded-2xl p-6 text-left mt-8 border border-slate-100 shadow-sm">
                <div class="flex flex-col gap-3">
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Nama Toko</span>
                        <span class="text-sm font-extrabold text-slate-800">{{ $toko->nama_toko }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Pemilik</span>
                        <span class="text-sm font-bold text-slate-700">{{ $penjual->user->name }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Tanggal</span>
                        <span class="text-sm font-bold text-slate-700">{{ $toko->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-1">
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Status</span>
                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-md border
                            @if($toko->status_verifikasi === 'Terverifikasi') bg-emerald-50 text-emerald-700 border-emerald-200
                            @elseif($toko->status_verifikasi === 'Ditolak') bg-rose-50 text-rose-700 border-rose-200
                            @else bg-amber-50 text-amber-700 border-amber-200
                            @endif">
                            {{ $toko->status_verifikasi }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- TOMBOL DINAMIS -->
            <div class="mt-8 flex flex-col gap-3">
                @if($toko->status_verifikasi === 'Terverifikasi')
                    <a href="{{ route('penjual.dashboard') }}"
                        class="w-full py-3.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl shadow-lg shadow-primary-600/30 text-sm font-bold text-center transition-all hover:-translate-y-0.5">
                        Masuk ke Dashboard Toko
                    </a>
                @elseif($toko->status_verifikasi === 'Ditolak')
                    <a href="#"
                        class="w-full py-3 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 rounded-xl shadow-sm text-sm font-bold text-center transition-colors">
                        Hubungi Admin
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-xl shadow-md text-sm font-bold text-center transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <button onclick="location.reload()"
                        class="w-full py-3.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl shadow-lg shadow-primary-600/30 text-sm font-bold text-center transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Perbarui Status
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full py-3 bg-white border border-slate-300 hover:bg-rose-50 hover:border-rose-300 hover:text-rose-600 text-slate-600 rounded-xl shadow-sm text-sm font-bold text-center transition-colors">
                            Logout Sementara
                        </button>
                    </form>
                @endif
            </div>

            @if($toko->status_verifikasi === 'Terverifikasi')
                <p class="text-xs text-slate-400 mt-8 font-medium">Toko Anda telah diverifikasi. Kelola produk dan terima pesanan sekarang.</p>
            @elseif($toko->status_verifikasi === 'Ditolak')
                <p class="text-xs text-slate-400 mt-8 font-medium">Permohonan verifikasi ditolak. Hubungi admin untuk penjelasan lebih lanjut.</p>
            @else
                <p class="text-xs text-slate-400 mt-8 font-medium leading-relaxed">Pendaftaran toko Anda sedang ditinjau oleh pengurus RT. Harap cek kembali halaman ini secara berkala.</p>
            @endif
        </div>
    </div>

    <script>
        setTimeout(() => { document.querySelector('.fade').classList.add('show'); }, 100);
    </script>
</body>
</html>