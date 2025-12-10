@extends('layouts.index')

@section('title', "$toko->nama_toko - CeMas")

@push('styles')
<style>
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('konten')
<div id="mainWrapper" class="grid transition-all duration-300 min-h-screen">
    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center relative gap-4">
            <a href="{{ route('pembeli.dashboard') }}" class="flex items-center text-gray-800 hover:text-gray-900 text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
            <div class="flex-1"></div>
            <a href="{{ route('keranjang.index') }}" class="relative p-2 text-gray-600 hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span id="cartCountBadge" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center hidden">0</span>
            </a>
        </div>
    </nav>

    <div>
        <!-- HEADER TOKO -->
        <header class="relative w-full h-96 overflow-hidden">
            <img src="{{ $toko->foto_toko ? asset($toko->foto_toko) : 'https://placehold.co/800x400?text=Toko' }}"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-white via-blue-50/70 to-transparent"></div>
        </header>

        <!-- KONTEN -->
        <section class="max-w-7xl mx-auto px-6 pb-16 -mt-40 relative z-15 fade-in">
            <!-- JUDUL TOKO -->
            <div class="absolute top-[-150px] left-10 text-gray-900 fade-in">
                <h1 class="text-6xl font-extrabold leading-tight">{{ $toko->nama_toko }}</h1>
            </div>

            <!-- INFO TOKO -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 fade-in mt-20">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Tentang Toko</h2>
                <p class="text-gray-600 leading-relaxed">{{ $toko->deskripsi_toko ?? 'Belum ada deskripsi.' }}</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-blue-50 p-4 rounded-xl shadow-inner">
                        <p class="font-semibold text-gray-700">Pemilik</p>
                        <p class="text-gray-900">{{ $toko->penjual->user->name }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl shadow-inner">
                        <p class="font-semibold text-gray-700">Alamat</p>
                        <p class="text-gray-900">{{ $toko->lokasi }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl shadow-inner">
                        <p class="font-semibold text-gray-700">Kontak</p>
                        <p class="text-gray-900">{{ $toko->penjual->phone }}</p>
                    </div>
                </div>
            </div>

            <!-- PRODUK SECTION -->
            <div class="mt-16 fade-in">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Produk Tersedia</h2>
                <hr class="mb-8">

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($toko->produks as $produk)
                    <div class="bg-white rounded-xl shadow hover:shadow-xl border border-gray-100 transition overflow-hidden">
                        <img src="{{ $produk->foto_produk ? asset($produk->foto_produk) : 'https://placehold.co/400x400?text=Produk' }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 text-sm h-10 line-clamp-2">{{ $produk->nama_produk }}</h3>



                            <p class="text-blue-600 font-bold mt-2 text-lg">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>

                            <p class="text-sm text-gray-600 mt-1">Stok: <span class="font-semibold">{{ $produk->stok }}</span></p>

                            <button type="button"
                                onclick="addToCart({{ $produk->id }})"
                                class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg flex items-center justify-center gap-2 transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                                {{ $produk->stok < 1 ? 'disabled' : '' }}>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ $produk->stok < 1 ? 'Habis' : '+ Keranjang' }}
                            </button>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-600 col-span-full text-center py-10">Belum ada produk di toko ini.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>

<!-- TOAST -->
<div id="toast" class="fixed top-5 right-0 z-50 transform translate-x-full transition-transform duration-300">
    <div class="bg-gray-800 text-white px-6 py-3 rounded-full shadow-2xl flex items-center gap-3">
        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span id="toastMsg" class="font-medium text-sm">Berhasil</span>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // On Load
    document.addEventListener('DOMContentLoaded', () => {
        loadCart();
    });

    function toggleCart(show) {
        const slide = document.getElementById('slideCart');
        const overlay = document.getElementById('cartOverlay');
        const main = document.getElementById('mainWrapper');

        if (show) {
            slide.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            main.classList.add('pr-80'); // Optional: push content
            loadCart(); // Refresh data
        } else {
            slide.classList.add('translate-x-full');
            overlay.classList.add('hidden');
            main.classList.remove('pr-80');
        }
    }

    async function loadCart() {
        try {
            const res = await fetch('{{ route("keranjang.items") }}');
            const items = await res.json();
            renderCartItems(items);
        } catch (e) {
            console.error(e);
        }
    }

    function renderCartItems(items) {
        const container = document.getElementById('cartItems');
        const totalEl = document.getElementById('cartTotal');
        const badge = document.getElementById('cartCountBadge');

        // Update Badge
        if (items.length > 0) {
            badge.innerText = items.length;
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }

        if (items.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center h-full text-gray-400">
                    <svg class="w-16 h-16 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <p>Keranjang kosong</p>
                    <button onclick="toggleCart(false)" class="mt-4 text-blue-600 text-sm hover:underline">Lanjut Belanja</button>
                </div>`;
            totalEl.innerText = 'Rp 0';
            document.getElementById('modalOrderTotal').innerText = 'Rp 0';
            document.getElementById('btnPesan').disabled = true;
            document.getElementById('btnPesan').classList.add('opacity-50', 'cursor-not-allowed');
            return;
        }

        document.getElementById('btnPesan').disabled = false;
        document.getElementById('btnPesan').classList.remove('opacity-50', 'cursor-not-allowed');

        let html = '';
        let total = 0;

        items.forEach(item => {
            const subtotal = item.jumlah_produk * item.produk.harga;
            total += subtotal;

            html += `
                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm flex gap-3 relative group">
                    <div class="bg-gray-100 w-16 h-16 rounded-lg flex-shrink-0 overflow-hidden">
                         <img src="${item.produk.foto_produk ? '/storage/'+item.produk.foto_produk : 'https://placehold.co/100x100?text=IMG'}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 text-sm line-clamp-1">${item.produk.nama_produk}</h4>
                        <div class="flex justify-between items-end mt-1">
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded text-xs">Qty: ${item.jumlah_produk}</span>
                            <span class="font-bold text-blue-600 text-sm">Rp${subtotal.toLocaleString('id-ID')}</span>
                        </div>
                    </div>
                    <button onclick="removeItem(${item.produk_id})" class="absolute -top-2 -right-2 bg-white text-red-500 rounded-full p-1 shadow-md opacity-0 group-hover:opacity-100 transition hover:bg-red-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            `;
        });

        container.innerHTML = html;
        const fmtTotal = 'Rp ' + total.toLocaleString('id-ID');
        totalEl.innerText = fmtTotal;
        document.getElementById('modalOrderTotal').innerText = fmtTotal;
    }

    async function addToCart(produkId) {
        try {
            const res = await fetch('{{ route("keranjang.tambah") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    produk_id: produkId
                })
            });

            const data = await res.json();

            if (res.ok) {
                showToast('Produk ditambahkan!');
                loadCart(); // Reload badge & drawer content
            } else {
                showToast(data.message || 'Gagal menambahkan', true);
            }
        } catch (e) {
            showToast('Terjadi kesalahan', true);
        }
    }

    async function removeItem(produkId) {
        try {
            const res = await fetch(`/keranjang/hapus/${produkId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (res.ok) {
                loadCart();
            }
        } catch (e) {
            console.error(e);
        }
    }

    function openOrderModalFromCart() {
        toggleCart(false);
        document.getElementById('orderModal').classList.remove('hidden');
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    function showToast(msg, isError = false) {
        const toast = document.getElementById('toast');
        const txt = document.getElementById('toastMsg');
        txt.innerText = msg;

        if (isError) toast.firstElementChild.classList.add('bg-red-700');
        else toast.firstElementChild.classList.remove('bg-red-700');

        toast.classList.remove('translate-x-full');
        setTimeout(() => {
            toast.classList.add('translate-x-full');
        }, 3000);
    }
</script>
@endpush