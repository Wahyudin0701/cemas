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

    <div class="max-w-4xl mx-auto px-4 py-8 fade-in">

        <h2 class="text-3xl font-extrabold text-gray-900">Keranjang Belanja</h2>
        <p class="text-gray-600 mt-2 mb-10">
            Informasi lengkap mengenai keranjang belanja.
        </p>

        @if (empty($cartGroups))
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-dashed border-gray-300">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-400">Keranjang masih kosong</h3>
                <a href="{{ route('pembeli.dashboard') }}"
                    class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Mulai
                    Belanja</a>
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
                        class="bg-white rounded-xl shadow-sm border overflow-hidden">
                        @csrf
                        <input type="hidden" name="toko_id" value="{{ $toko->id }}">

                        <!-- Header Toko -->
                        <div class="bg-gray-50 px-6 py-3 border-b flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                <span class="font-bold text-gray-800 text-lg">{{ $toko->nama_toko }}</span>
                            </div>
                            <!-- Pilihan Pengambilan per Toko -->
                            <div>
                                <select name="metode_pengambilan"
                                    class="text-sm border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="Diantar Penjual">Diantar Penjual</option>
                                    <option value="Ambil di Toko">Ambil Sendiri</option>
                                </select>
                            </div>
                        </div>

                        <div class="divide-y">
                            @foreach ($items as $item)
                                <div id="item-{{ $item->id }}" class="p-4 flex gap-4 items-center">
                                    <!-- Foto Produk -->
                                    <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if ($item->produk->foto_produk_url)
                                            <img src="{{ asset($item->produk->foto_produk_url) }}"
                                                class="w-full h-full object-cover" alt="{{ $item->produk->nama_produk }}">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                                                IMG</div>
                                        @endif
                                    </div>

                                    <!-- Detail Produk -->
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">{{ $item->produk->nama_produk }}</h4>
                                        <p class="text-blue-600 font-bold mt-1">
                                            Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <!-- Qty Control -->
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="updateQty('{{ $item->id }}', -1)"
                                            class="w-8 h-8 rounded-full border flex items-center justify-center hover:bg-gray-100 text-gray-600 font-bold">-</button>
                                        <input type="number" id="qty-{{ $item->id }}"
                                            value="{{ $item->jumlah_produk }}"
                                            class="w-12 text-center border-none text-gray-800 font-medium focus:ring-0 appearance-none bg-transparent"
                                            readonly>
                                        <button type="button" onclick="updateQty('{{ $item->id }}', 1)"
                                            class="w-8 h-8 rounded-full border flex items-center justify-center hover:bg-gray-100 text-gray-600 font-bold">+</button>
                                    </div>

                                    <!-- Hapus -->
                                    <button type="button" onclick="removeItem('{{ $item->produk_id }}')"
                                        class="text-gray-400 hover:text-red-500 p-2 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Footer per Toko -->
                        <div class="bg-blue-50/50 p-4 border-t flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <textarea name="catatan_pembeli" rows="1"
                                    class="w-full md:w-80 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400 text-sm p-2"
                                    placeholder="Catatan untuk penjual..."></textarea>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">Total Toko</p>
                                    <h3 id="shop-total-{{ $toko->id }}" class="text-xl font-bold text-blue-700">Rp
                                        {{ number_format($subtotalToko, 0, ',', '.') }}</h3>
                                </div>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-md flex items-center gap-2">
                                    Checkout Toko Ini
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </form>
                @endforeach
            </div>

            <!-- Spacer -->
            <div class="h-20"></div>

        @endif
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="toast"
        class="fixed top-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg transform translate-y-[-150%] transition duration-300 z-50">
        <span id="toast-message">Notifikasi</span>
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
            toast.className =
                `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition duration-300 z-50 ${isError ? 'bg-red-600' : 'bg-gray-800'} text-white translate-y-0`;

            // Clear previous timeout if any (simple implementation)
            if (toast.timeoutId) clearTimeout(toast.timeoutId);

            toast.timeoutId = setTimeout(() => {
                toast.classList.add('translate-y-[-150%]');
                toast.classList.remove('translate-y-0');
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
