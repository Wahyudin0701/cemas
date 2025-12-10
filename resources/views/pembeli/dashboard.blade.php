@extends('layouts.pembeli')

@section('title', 'Dashboard Pembeli - CeMas')

@push('styles')
    <style>
        /* Smooth fade animation */
        .fade-in {
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.6s ease-out;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-bg {
            background: linear-gradient(135deg, #eef3ff 0%, #dee8ff 100%);
        }

        .card {
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06);
        }
    </style>
@endpush

@section('content')

    <section
        class="pt-24 pb-24 min-h-screen flex items-center fade-in bg-gradient-to-br from-gray-50 via-blue-50 to-blue-300">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                    Platform UMKM Digital Berbasis Komunitas
                </h1>
                <h2 class="text-2xl mt-3 font-semi">
                    Community E-Marketplace Aston Villa
                </h2>

                <p class="mt-6 text-lg text-gray-600 max-w-md leading-relaxed">
                    Belanja kebutuhan harian, makanan, dan lain lain dari tetangga Anda sendiri.
                    CeMas mendukung pemberdayaan warga melalui digitalisasi UMKM lingkungan.
                </p>

                <a href="#daftar-toko"
                    class="mt-8 inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full shadow-lg transition">
                    Jelajahi Toko Warga
                    <span class="ml-2">→</span>
                </a>
            </div>
            <div class="hidden md:block">
                <img src="{{ asset('Images/lorong_asvil.jpg') }}"
                    class="rounded-xl shadow-lg hover:scale-[1.02] duration-500" alt="Lorong Aston Villa">
            </div>
        </div>
    </section>

    <!-- DAFTAR TOKO -->
    <section id="daftar-toko" class="min-h-screen pt-24 bg-gradient-to-tr from-gray-50 via-blue-50 to-blue-300">
        <div class="max-w-7xl mx-auto px-4">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900">Toko Warga Terverifikasi</h2>
                <p class="mt-4 text-gray-600 text-lg">
                    Belanja aman dari UMKM lokal yang telah diverifikasi pengurus RT.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                @foreach ($tokoList as $toko)
                    <div
                        class="card bg-white p-6 rounded-xl shadow border border-gray-100 
                            transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        @if($toko->foto_toko_url)
                        <img src="{{ $toko->foto_toko_url ?? 'https://placehold.co/400x400?text=Toko' }}"
                            class="w-full h-36 object-cover">
                        @endif
                        <h3 class="text-xl font-bold text-gray-900">{{ $toko->nama_toko }}</h3>

                        <p class="text-gray-600 mt-2">
                            {{ $toko->deskripsi_toko ?? 'Tidak ada deskripsi.' }}
                        </p>

                        <span class="text-orange-600 text-sm font-medium mt-3 inline-block">
                            {{ $toko->lokasi }}
                        </span>

                        <div class="mt-4">
                            <a href="{{ route('detail-toko', $toko->id) }}"
                                class="text-blue-600 hover:text-blue-800 font-semibold">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                @endforeach

                {{-- Jika tidak ada toko terverifikasi --}}
                @if ($tokoList->isEmpty())
                    <p class="text-gray-600 text-center col-span-full">
                        Belum ada toko yang terverifikasi.
                    </p>
                @endif

            </div>
        </div>
    </section>


    <!-- TENTANG KAMI -->
    <section id="tentang" class="py-24 bg-gradient-to-b from-white to-blue-50">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Heading -->
            <div class="text-center mb-14 fade-in">
                <h2 class="text-4xl font-extrabold text-gray-900">Tentang CeMas</h2>
                <p class="mt-4 text-gray-600 text-lg max-w-2xl mx-auto">
                    CeMas (Community E-Marketplace Aston Villa) hadir untuk mendukung UMKM warga
                    dengan platform digital sederhana, aman, dan mudah digunakan.
                </p>
            </div>

            <!-- GRID CONTENT -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 fade-in">

                <!-- CARD 1 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-md border border-gray-100 hover:shadow-lg 
                        transition duration-300 text-center">

                    <h3 class="text-lg font-bold text-gray-900 mt-5">Memberdayakan UMKM</h3>
                    <p class="text-gray-600 text-sm mt-2">
                        Membantu warga Aston Villa memasarkan produk dan jasa mereka melalui platform daring
                        yang mudah diakses.
                    </p>
                </div>

                <!-- CARD 2 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-md border border-gray-100 hover:shadow-lg 
                        transition duration-300 text-center">

                    <h3 class="text-lg font-bold text-gray-900 mt-5">Untuk Komunitas</h3>
                    <p class="text-gray-600 text-sm mt-2">
                        CeMas dibangun khusus untuk warga, sehingga transaksi lebih dekat, mudah, dan mendukung ekonomi
                        lokal.
                    </p>
                </div>

                <!-- CARD 3 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-md border border-gray-100 hover:shadow-lg 
                        transition duration-300 text-center">

                    <h3 class="text-lg font-bold text-gray-900 mt-5">Aman & Terverifikasi</h3>
                    <p class="text-gray-600 text-sm mt-2">
                        Setiap toko diverifikasi oleh pengurus RT, sehingga pembeli dapat berbelanja dengan rasa aman.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-6 text-center">
        <p>© {{ date('Y') }} CeMas — Dibuat oleh Warga, untuk Warga.</p>
    </footer>
@endsection

@push('scripts')
    <script>
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('show');
            });
        });
        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
    </script>
@endpush
