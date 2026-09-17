@extends('layouts.pembeli')

@section('title', 'Keranjang Belanja')

@push('styles')
    <style>
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
@endpush

@section('content')

    <div class="max-w-5xl mx-auto px-6 py-12 fade-in min-h-screen">

        <div class="mb-10">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Keranjang Belanja</h2>
            <p class="text-slate-500 mt-2 font-medium">
                Periksa kembali pesanan Anda sebelum melanjutkan ke pembayaran.
            </p>
        </div>

        @if (empty($cartGroups))
            <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-slate-200 border-dashed">
                <svg class="w-24 h-24 text-slate-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h3 class="text-xl font-bold text-slate-700">Keranjang masih kosong</h3>
                <p class="text-slate-500 mt-2 mb-6">Yuk temukan produk menarik dari tetangga Anda!</p>
                <a href="{{ route('pembeli.dashboard') }}"
                    class="inline-flex items-center px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 hover:-translate-y-0.5 shadow-lg shadow-primary-600/30 transition-all">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-8">
                <!-- Loop through each Cart Group (Shop) -->
                @foreach ($cartGroups as $group)
                    @php
                        $toko = $group['toko'];
                        $items = $group['items'];
                        $subtotalToko = 0;
                        foreach ($items as $i) {
                            $subtotalToko += $i->jumlah_produk * $i->produk->harga;
                        }
                    @endphp

                    <!-- FORM CHECKOUT PER TOKO -->
                    <form action="{{ route('checkout.process') }}" method="POST"
                        class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden group hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-300">
                        @csrf
                        <input type="hidden" name="toko_id" value="{{ $toko->id }}">

                        <!-- Header Toko -->
                        <div class="bg-gradient-to-r from-slate-50 to-white px-5 py-4 border-b border-slate-100 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600 shadow-sm border border-primary-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-bold text-slate-800 text-lg block leading-tight">{{ $toko->nama_toko }}</span>
                                    <span class="text-xs text-slate-500 font-medium mt-0.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $toko->lokasi }}
                                    </span>
                                </div>
                            </div>
                            <!-- Pilihan Pengambilan per Toko -->
                            <div>
                                <select name="metode_pengambilan"
                                    class="text-sm border-slate-200 text-slate-700 font-bold py-2 pl-3 pr-10 rounded-lg focus:border-primary-500 focus:ring-primary-500 bg-white shadow-sm hover:border-primary-300 transition-colors cursor-pointer">
                                    <option value="Diantar Penjual">🛵 Diantar Penjual</option>
                                    <option value="Ambil di Toko">🏪 Ambil di Toko</option>
                                </select>
                            </div>
                        </div>

                        <div class="divide-y divide-slate-100/80 p-2 md:p-4">
                            @foreach ($items as $item)
                                <div id="item-{{ $item->id }}" class="p-4 flex flex-wrap md:flex-nowrap gap-5 items-center hover:bg-slate-50/50 rounded-2xl transition-colors">
                                    <!-- Foto Produk -->
                                    <div class="w-20 h-20 md:w-24 md:h-24 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0 border border-slate-200/60 shadow-sm relative group-hover:shadow-md transition-shadow">
                                        @if ($item->produk->foto_produk_url)
                                            <img src="{{ asset($item->produk->foto_produk_url) }}"
                                                class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500" alt="{{ $item->produk->nama_produk }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Detail Produk -->
                                    <div class="flex-1 min-w-[150px]">
                                        <h4 class="font-bold text-slate-800 text-base">{{ $item->produk->nama_produk }}</h4>
                                        <p class="text-primary-600 font-extrabold mt-1 text-lg tracking-tight">
                                            Rp{{ number_format($item->produk->harga, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-4 ml-auto bg-white p-1.5 rounded-xl border border-slate-100 shadow-sm">
                                        <!-- Qty Control -->
                                        <div class="flex items-center bg-slate-50 rounded-lg border border-slate-200 overflow-hidden">
                                            <button type="button" onclick="updateQty('{{ $item->id }}', -1)"
                                                class="w-8 h-8 flex items-center justify-center hover:bg-slate-200 text-slate-600 hover:text-slate-900 transition-all font-bold text-lg active:bg-slate-300">-</button>
                                            <input type="number" id="qty-{{ $item->id }}"
                                                value="{{ $item->jumlah_produk }}"
                                                class="w-10 text-center border-none text-slate-800 font-bold focus:ring-0 appearance-none bg-transparent p-0 text-sm"
                                                readonly>
                                            <button type="button" onclick="updateQty('{{ $item->id }}', 1)"
                                                class="w-8 h-8 flex items-center justify-center hover:bg-slate-200 text-slate-600 hover:text-slate-900 transition-all font-bold text-lg active:bg-slate-300">+</button>
                                        </div>

                                        <!-- Hapus -->
                                        <button type="button" onclick="removeItem('{{ $item->produk_id }}')"
                                            class="text-slate-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors group" title="Hapus Produk">
                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Footer per Toko -->
                        <div class="bg-primary-50/50 p-5 md:p-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                            <div class="absolute -right-10 -bottom-10 w-24 h-24 bg-primary-100 rounded-full opacity-50 pointer-events-none"></div>
                            
                            <div class="w-full md:w-1/2 relative z-10">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Catatan Pesanan (Opsional)
                                </label>
                                <textarea name="catatan_pembeli" rows="1"
                                    class="w-full border-slate-200 rounded-lg focus:border-primary-500 focus:ring-primary-500 placeholder-slate-400 text-sm py-2 px-3 transition-colors resize-none shadow-sm"
                                    placeholder="Contoh: Tolong pilihkan yang segar..."></textarea>
                            </div>

                            <div class="flex items-center gap-5 w-full md:w-auto justify-between md:justify-end relative z-10">
                                <div class="text-right">
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Subtotal Toko</p>
                                    <h3 id="shop-total-{{ $toko->id }}" class="text-xl md:text-2xl font-black text-primary-700 tracking-tight drop-shadow-sm">Rp{{ number_format($subtotalToko, 0, ',', '.') }}</h3>
                                </div>
                                <button type="submit"
                                    class="px-6 py-2.5 bg-primary-600 text-white font-bold text-base rounded-lg hover:bg-primary-700 hover:-translate-y-0.5 transition-all shadow-md shadow-primary-600/30 flex items-center gap-2 group">
                                    Checkout
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        @endif
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="toast"
        class="fixed top-24 right-6 bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl transform translate-y-[-150%] opacity-0 transition-all duration-300 z-50 flex items-center gap-3">
        <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span id="toast-message" class="font-medium">Notifikasi</span>
    </div>
@endsection

@push('scripts')
    <script>
        // csrfToken is already defined in layout
        const updateQtyUrl = "{{ route('keranjang.updateQty') }}";
        // Base URL for delete (remove trailing slash if needed, though clean way is to append id)
        const deleteBaseUrl = "{{ url('/keranjang/hapus') }}";

        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            const msgEl = document.getElementById('toast-message');
            if (!toast || !msgEl) return;

            msgEl.textContent = message;
            
            // Remove previous color classes
            toast.classList.remove('bg-slate-900', 'bg-red-600', 'text-white', 'opacity-0', 'translate-y-[-150%]');
            
            if (isError) {
                toast.classList.add('bg-red-600', 'text-white');
            } else {
                toast.classList.add('bg-slate-900', 'text-white');
            }

            // Show
            toast.classList.add('opacity-100', 'translate-y-0');

            // Clear previous timeout if any
            if (toast.timeoutId) clearTimeout(toast.timeoutId);

            toast.timeoutId = setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-[-150%]');
            }, 3000);
        }

        async function updateQty(detailId, change) {
            const qtyInput = document.getElementById(`qty-${detailId}`);
            if (!qtyInput) return;

            // Disable buttons temporarily to prevent spam
            // (Optional improvement, but good for UX)

            try {
                const response = await fetch(updateQtyUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        detail_id: detailId,
                        change: change
                    })
                });

                // Handle non-200 responses
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(errorData.error || errorData.message || `Server Error: ${response.status}`);
                }

                const data = await response.json();

                if (data.error) {
                    showToast(data.error, true);
                    return;
                }

                // Handle UI Updates
                const itemRow = document.getElementById(`item-${detailId}`);

                // Find Toko Context (Form)
                let form = null;
                let tokoId = null;
                if (itemRow) {
                    form = itemRow.closest('form');
                    if (form) {
                        const tokoInput = form.querySelector('input[name="toko_id"]');
                        if (tokoInput) tokoId = tokoInput.value;
                    }
                }

                if (data.status === 'deleted') {
                    if (itemRow) {
                        // Add fade out effect
                        itemRow.style.opacity = '0';
                        setTimeout(() => itemRow.remove(), 300);
                    }
                } else if (data.status === 'updated') {
                    if (qtyInput) qtyInput.value = data.new_qty;
                }

                // Update Shop Total
                if (tokoId && data.shop_total_formatted) {
                    const totalEl = document.getElementById(`shop-total-${tokoId}`);
                    if (totalEl) totalEl.innerText = 'Rp ' + data.shop_total_formatted;
                }

                // Cleanup: If shop has no items left
                if (form && data.status === 'deleted') {
                    // Wait a bit for DOM removal
                    setTimeout(() => {
                        const remainingItems = form.querySelectorAll('[id^="item-"]');
                        if (remainingItems.length === 0) {
                            form.remove();
                            // If no forms left, reload to show empty state
                            const remainingForms = document.querySelectorAll(
                                "form[action='{{ route('checkout.process') }}']");
                            if (remainingForms.length === 0) {
                                location.reload();
                            }
                        }
                    }, 350);
                }

            } catch (error) {
                console.error('Update Qty Error:', error);
                showToast(error.message || 'Gagal menghubungi server', true);
            }
        }

        async function removeItem(produkId) {
            if (!confirm('Hapus produk ini dari keranjang?')) return;

            try {
                const response = await fetch(`${deleteBaseUrl}/${produkId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(errorData.error || `Gagal menghapus item (${response.status})`);
                }

                const data = await response.json();

                if (data.success) {
                    // Reload is simple and ensuring consistency, but we could also animate removal.
                    // For delete, reload is acceptable as per original code.
                    location.reload();
                } else {
                    showToast('Gagal menghapus item', true);
                }

            } catch (error) {
                console.error('Remove Item Error:', error);
                showToast(error.message, true);
            }
        }
    </script>
@endpush
