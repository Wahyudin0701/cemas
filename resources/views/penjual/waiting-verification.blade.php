<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Verifikasi - CeMas</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Fade minimal */
        .fade {
            opacity: 0;
            transform: translateY(8px);
            transition: .5s ease;
        }

        .fade.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Simple loading animation */
        .dot {
            animation: blink 1.5s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: .2;
            }

            50% {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-b from-blue-50 to-gray-100">

    <!-- MAIN CONTENT -->
    <div class="max-w-xl mx-auto px-6 pt-10 fade min-h-screen">

        <div class="bg-white shadow-lg rounded-2xl p-10 border border-gray-100 text-center">

            <!-- Icon -->
            <div class="mb-6">
                <div class="w-20 h-20 mx-auto rounded-full 
            @if($toko->status_verifikasi === 'Terverifikasi')
                bg-green-100
            @elseif($toko->status_verifikasi === 'Ditolak')
                bg-red-100
            @else
                bg-blue-100
            @endif
            flex items-center justify-center">

                    @if($toko->status_verifikasi === 'Terverifikasi')
                    <!-- ICON TERVERIFIKASI -->
                    <svg width="45" height="45" fill="none" stroke="#16a34a" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M16 10l-4 4-2-2"></path>
                    </svg>

                    @elseif($toko->status_verifikasi === 'Ditolak')
                    <!-- ICON DITOLAK -->
                    <svg width="45" height="45" fill="none" stroke="#dc2626" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>

                    @else
                    <!-- ICON MENUNGGU -->
                    <svg width="45" height="45" fill="none" stroke="#2563eb" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                    @endif
                </div>
            </div>


            <!-- JUDUL & PESAN -->
            @if($toko->status_verifikasi === 'Terverifikasi')

            <h2 class="text-2xl font-bold text-gray-900">Toko Anda Telah Diverifikasi</h2>
            <p class="text-gray-600 mt-2 leading-relaxed">
                Selamat! Anda sudah dapat mengakses seluruh fitur dashboard penjual.
            </p>

            @elseif($toko->status_verifikasi === 'Ditolak')

            <h2 class="text-2xl font-bold text-red-600">Verifikasi Ditolak</h2>
            <p class="text-gray-600 mt-2 leading-relaxed">
                Pengajuan verifikasi toko Anda ditolak oleh pengurus RT.<br>
                Silakan periksa kembali data dan dokumen yang Anda unggah.
            </p>

            @else

            <h2 class="text-2xl font-bold text-gray-900">Menunggu Verifikasi Toko</h2>
            <p class="text-gray-600 mt-2 leading-relaxed">
                Pendaftaran toko Anda sedang ditinjau. Mohon menunggu sebentar ya.
            </p>

            <!-- Loading dots -->
            <div class="flex justify-center items-center mt-4 gap-1 text-blue-600 font-bold">
                <span class="dot">●</span>
                <span class="dot" style="animation-delay:.2s">●</span>
                <span class="dot" style="animation-delay:.4s">●</span>
            </div>

            @endif


            <!-- INFO BOX -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 text-left mt-8">
                <p class="text-sm text-gray-700 mt-2">
                    <span class="font-medium">Nama Toko:</span>
                    {{ $toko->nama_toko }}
                </p>

                <p class="text-sm text-gray-700 mt-2">
                    <span class="font-medium">Pemilik:</span>
                    {{ $penjual->user->name }}
                </p>

                <p class="text-sm text-gray-700 mt-2">
                    <span class="font-medium">Tanggal Daftar:</span>
                    {{ $toko->created_at->format('d M Y') }}
                </p>

                <p class="text-sm text-gray-700 mt-1">
                    <span class="font-medium">Status:</span>
                    <span class="
                @if($toko->status_verifikasi === 'Terverifikasi') text-green-600
                @elseif($toko->status_verifikasi === 'Ditolak') text-red-600
                @else text-yellow-600
                @endif font-semibold">
                        {{ $toko->status_verifikasi }}
                    </span>
                </p>
            </div>


            <!-- TOMBOL DINAMIS -->
            <div class="mt-8 flex flex-col gap-3">

                @if($toko->status_verifikasi === 'Terverifikasi')

                <a href="{{ route('penjual.dashboard') }}"
                    class="w-full py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow text-sm text-center">
                    Masuk ke Dashboard Toko
                </a>

                @elseif($toko->status_verifikasi === 'Ditolak')

                <a href="#"
                    class="w-full py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow text-sm text-center">
                    Chat Admin
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full py-2  bg-red-500 hover:bg-red-600 rounded-lg text-white shadow text-sm text-center">
                        Logout
                    </button>
                </form>

                @else

                <button onclick="location.reload()"
                    class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow text-sm">
                    Perbarui Status
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full py-2  bg-red-500 hover:bg-red-600 rounded-lg text-white shadow text-sm text-center">
                        Logout
                    </button>
                </form>

                @endif
            </div>


            @if($toko->status_verifikasi === 'Terverifikasi')
            <p class="text-xs text-gray-400 mt-6">
                Toko Anda telah diverifikasi. Anda kini dapat mengelola produk, menerima pesanan, dan mengakses seluruh fitur dashboard. Hubungi admin jika membutuhkan bantuan.
            </p>
            @elseif($toko->status_verifikasi === 'Ditolak')
            <p class="text-xs text-gray-400 mt-6">
                Permohonan verifikasi ditolak. Periksa data dan dokumen yang diajukan, lalu ajukan kembali atau hubungi admin untuk penjelasan.
            </p>
            @else
            <p class="text-xs text-gray-400 mt-6">
                Pendaftaran toko Anda sedang ditinjau oleh pengurus RT. Kami akan menghubungi Anda jika diperlukan — harap cek email atau notifikasi secara berkala.
            </p>
            @endif

        </div>


    </div>

    <script>
        setTimeout(() => {
            document.querySelector('.fade').classList.add('show');
        }, 120);
    </script>

</body>

</html>