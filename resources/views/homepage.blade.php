@extends('layouts.index')

@section('title', 'Homepage')

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

        .navbar-blur {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.6);
            transition: background-color 0.3s ease;
        }

        .navbar-solid {
            background-color: rgba(255, 255, 255, 1) !important;
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

        .dropdown-anim {
            transform-origin: top right;
            transform: scale(0.95) translateY(-8px);
            opacity: 0;
            transition: all 0.18s ease-out;
        }

        .dropdown-open {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    </style>
@endpush

@section('konten')

    <nav id="navbar" class="navbar-blur fixed top-0 w-full z-20 shadow-sm bg-white/70 backdrop-blur">

        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">

            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-blue-600 tracking-tight">CeMas</a>

            <!-- Menu Tengah -->
            <div class="hidden md:flex space-x-6">
                <a href="/" class="text-sm font-medium hover:text-blue-600">Homepage</a>
                <a href="#daftar-toko" class="text-sm font-medium text-gray-600 hover:text-blue-600">Daftar Toko</a>
                <a href="#tentang" class="text-sm font-medium text-gray-600 hover:text-blue-600">Tentang Kami</a>
            </div>

            <!-- Kanan -->
            <div class="relative">

                @auth
                    <!-- Avatar -->
                    <button onclick="toggleProfileMenu()" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                            class="w-9 h-9 rounded-full border shadow-sm">
                    </button>

                    <!-- Dropdown -->
                    <div id="profileDropdown"
                        class="absolute right-0 mt-3 w-48 bg-white border border-gray-200
                        rounded-xl shadow-lg py-2 hidden dropdown-anim">

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Edit Akun
                        </a>

                        <a href="{{ route('riwayat-pesanan') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Riwayat Pesanan
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Guest → tombol Login -->
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 shadow">
                        Login
                    </a>

                    <!-- Register Dropdown -->
                    <div class="relative inline-block text-left ml-2">
                        <button type="button" onclick="toggleRegisterMenu()" id="registerBtn"
                            class="px-4 py-2 rounded-lg bg-blue-500 text-white text-sm hover:bg-blue-600 shadow flex items-center">

                            Register

                            <!-- Arrow Icon -->
                            <svg id="registerArrow" class="ml-2 -mr-1 h-4 w-4 transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <!-- Default: arrow DOWN -->
                                <path id="arrowPath" fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div id="registerDropdown"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden dropdown-anim">
                            <div class="py-1">
                                <a href="{{ route('register.pembeli') }}"
                                    class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">Sebagai Pembeli</a>
                                <a href="{{ route('register.penjual') }}"
                                    class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">Sebagai Penjual</a>
                            </div>
                        </div>
                    </div>


                @endauth

            </div>
        </div>
    </nav>

    <section
        class="pt-32 pb-24 min-h-screen flex items-center fade-in bg-gradient-to-br from-gray-50 via-blue-50 to-blue-300">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                    Platform UMKM Warga Aston Villa
                </h1>
                <h2 class="text-2xl mt-3 font-semi">
                    Community E-Marketplace
                </h2>

                <p class="mt-6 text-lg text-gray-600 max-w-md leading-relaxed">
                    Belanja kebutuhan harian, makanan, dan jasa dari tetangga Anda sendiri.
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
    <section id="daftar-toko" class="py-28 bg-gradient-to-tr from-gray-50 via-blue-50 to-blue-300">
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

                        <img src="{{ $toko->foto_toko ? asset($toko->foto_toko) : 'https://placehold.co/400x400?text=Toko' }}"
                            class="w-full h-36 object-cover">

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

        // Navbar solid on scroll
        const navbar = document.getElementById("navbar");
        window.addEventListener("scroll", () => {
            if (window.scrollY > 40) {
                navbar.classList.add("navbar-solid");
            } else {
                navbar.classList.remove("navbar-solid");
            }
        });

        function toggleProfileMenu() {
            const dropdown = document.getElementById('profileDropdown');

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');

                // Delay sedikit agar transisi bisa berjalan
                setTimeout(() => {
                    dropdown.classList.add('dropdown-open');
                }, 10);
            } else {
                dropdown.classList.remove('dropdown-open');
                setTimeout(() => {
                    dropdown.classList.add('hidden');
                }, 150);
            }
        }
        // Klik di luar menutup dropdown
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const avatarBtn = e.target.closest('button');

            if (!avatarBtn && !e.target.closest('#profileDropdown')) {
                dropdown.classList.remove('dropdown-open');
                setTimeout(() => {
                    dropdown.classList.add('hidden');
                }, 150);
            }
        });

        function toggleRegisterMenu() {
            const dropdown = document.getElementById('registerDropdown');
            const arrow = document.getElementById('arrowPath');

            const arrowDown =
                "M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z";
            const arrowUp =
                "M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z";

            if (dropdown.classList.contains('hidden')) {
                // OPEN
                dropdown.classList.remove('hidden');
                setTimeout(() => dropdown.classList.add('dropdown-open'), 10);

                // Panah ke atas ↑
                arrow.setAttribute("d", arrowUp);

            } else {
                // CLOSE
                dropdown.classList.remove('dropdown-open');
                setTimeout(() => dropdown.classList.add('hidden'), 150);

                // Panah ke bawah ↓
                arrow.setAttribute("d", arrowDown);
            }
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('registerDropdown');
            const registerBtn = document.getElementById('registerBtn');
            const arrow = document.getElementById('arrowPath');

            const arrowDown =
                "M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z";

            if (!registerBtn.contains(e.target) && !dropdown.contains(e.target)) {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('dropdown-open');
                    setTimeout(() => dropdown.classList.add('hidden'), 150);

                    // Reset ke panah bawah ↓
                    arrow.setAttribute("d", arrowDown);
                }
            }
        });
    </script>
@endpush
