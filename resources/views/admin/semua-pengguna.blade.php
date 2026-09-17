@extends('layouts.admin')

@section('title', 'Semua Pengguna')

@push('styles')
<style>
    .fade-in {
        opacity: 0;
        transform: translateY(12px);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .fade-in.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<!-- MAIN CONTENT -->
<div class="max-w-7xl mx-auto px-6 py-12 fade-in min-h-screen" x-data="{ showModal: false, actionUrl: '', modalTitle: '', modalMessage: '' }">

    <div class="mb-10">
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Semua Pengguna</h2>
        <p class="text-slate-500 mt-2 font-medium">
            Kelola dan pantau seluruh pengguna sistem berdasarkan role dan statusnya.
        </p>
    </div>

    <!-- FILTER BUTTONS -->
    <div class="flex flex-wrap gap-3 mb-8 bg-white p-2 rounded-2xl w-fit shadow-sm border border-slate-200">
        <button type="button" id="filter-all" onclick="filterUsers('all')"
            class="filter-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm
               bg-primary-600 text-white shadow-primary-600/30">
            Semua
        </button>

        <button type="button" id="filter-penjual" onclick="filterUsers('penjual')"
            class="filter-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all
               bg-transparent text-slate-600 hover:bg-slate-50">
            Penjual
        </button>

        <button type="button" id="filter-pembeli" onclick="filterUsers('pembeli')"
            class="filter-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all
               bg-transparent text-slate-600 hover:bg-slate-50">
            Pembeli
        </button>
    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="p-6 font-bold text-slate-500 uppercase tracking-wider text-xs">Pengguna</th>
                        <th class="p-6 font-bold text-slate-500 uppercase tracking-wider text-xs">Email & Kontak</th>
                        <th class="p-6 font-bold text-slate-500 uppercase tracking-wider text-xs">Role</th>
                        <th class="p-6 font-bold text-slate-500 uppercase tracking-wider text-xs">Status Toko</th>
                        <th class="p-6 font-bold text-slate-500 uppercase tracking-wider text-xs">Status Akun</th>
                        <th class="p-6 font-bold text-slate-500 uppercase tracking-wider text-xs text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody id="userTable" class="divide-y divide-slate-100">
                    @forelse ($pengguna as $user)

                    @php
                    $role = $user->role->value ?? 'lainnya';
                    $status = null;
                    if ($role === 'penjual') {
                        $status = $user->penjual->toko->status_verifikasi ?? 'Tidak Ada';
                    }
                    @endphp

                    <tr class="user-row hover:bg-slate-50/50 transition-colors" data-role="{{ $role }}">
                        <!-- PENGGUNA -->
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg
                                    @if($role === 'penjual') bg-primary-100 text-primary-700
                                    @elseif($role === 'pembeli') bg-purple-100 text-purple-700
                                    @else bg-slate-100 text-slate-700 @endif">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-base">{{ $user->name }}</p>
                                    <p class="text-xs font-medium text-slate-500 mt-0.5">Joined {{ $user->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- EMAIL -->
                        <td class="p-6">
                            <p class="font-medium text-slate-700">{{ $user->email }}</p>
                            @if($role === 'penjual' && isset($user->penjual->phone))
                                <p class="text-xs font-medium text-slate-500 mt-0.5">{{ $user->penjual->phone }}</p>
                            @endif
                        </td>

                        <!-- ROLE -->
                        <td class="p-6">
                            @if ($role === 'penjual')
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-lg bg-primary-50 text-primary-700 border border-primary-200">
                                Penjual
                            </span>
                            @elseif ($role === 'pembeli')
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-lg bg-purple-50 text-purple-700 border border-purple-200">
                                Pembeli
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-lg bg-slate-50 text-slate-700 border border-slate-200">
                                Lainnya
                            </span>
                            @endif
                        </td>

                        <!-- STATUS TOKO (Only for Sellers) -->
                        <td class="p-6">
                            @if ($role === 'penjual')
                                @if ($status === 'Terverifikasi')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Terverifikasi
                                </span>
                                @elseif ($status === 'Menunggu')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-lg bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Menunggu
                                </span>
                                @elseif ($status === 'Ditolak')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-lg bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Ditolak
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-lg bg-slate-50 text-slate-600 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Pending
                                </span>
                                @endif
                            @else
                                <span class="text-slate-400 font-medium italic text-xs">-</span>
                            @endif
                        </td>

                        <!-- STATUS AKUN -->
                        <td class="p-6">
                            @if($user->is_active)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-lg text-emerald-700 bg-emerald-50 border border-emerald-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-lg text-rose-700 bg-rose-50 border border-rose-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Diblokir
                            </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="p-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.detail-pengguna', $user->id) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-50 text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors border border-slate-200 hover:border-primary-200" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>

                                <button type="button" 
                                    @click="showModal = true; actionUrl = '{{ route('admin.toggle-status-user', $user->id) }}'; modalTitle = '{{ $user->is_active ? 'Blokir' : 'Aktifkan' }} Pengguna'; modalMessage = 'Apakah Anda yakin ingin {{ $user->is_active ? 'memblokir' : 'mengaktifkan' }} akun {{ addslashes($user->name) }}?'"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg transition-colors border {{ $user->is_active ? 'bg-slate-50 text-rose-500 hover:bg-rose-50 border-slate-200 hover:border-rose-200' : 'bg-slate-50 text-emerald-500 hover:bg-emerald-50 border-slate-200 hover:border-emerald-200' }}" title="{{ $user->is_active ? 'Blokir' : 'Aktifkan' }}">
                                    @if($user->is_active)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @endif
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Belum ada pengguna</h3>
                            <p class="text-slate-500 font-medium">Sistem saat ini belum memiliki pengguna terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Custom Confirm Modal -->
    <template x-teleport="body">
        <div x-show="showModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm" style="display: none;" x-transition.opacity>
            <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl transform transition-all"
                 x-show="showModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 @click.away="showModal = false">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900" x-text="modalTitle">Konfirmasi</h3>
                        <p class="text-sm font-medium text-slate-500 mt-1" x-text="modalMessage">Apakah Anda yakin?</p>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</button>
                    <form :action="actionUrl" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-primary-600 hover:bg-primary-700 transition-colors shadow-sm shadow-primary-600/30">Ya, Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

@push('scripts')
<script>
    setTimeout(() => { document.querySelectorAll('.fade-in').forEach(el => el.classList.add('show')); }, 100);

    function filterUsers(type) {
        const rows = document.querySelectorAll('.user-row');
        rows.forEach(row => {
            const role = row.dataset.role;
            row.style.display = (type === 'all' || role === type) ? '' : 'none';
        });

        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('bg-primary-600', 'text-white', 'shadow-sm', 'shadow-primary-600/30');
            btn.classList.add('bg-transparent', 'text-slate-600');
        });

        const activeBtn = document.getElementById('filter-' + type);
        if (activeBtn) {
            activeBtn.classList.add('bg-primary-600', 'text-white', 'shadow-sm', 'shadow-primary-600/30');
            activeBtn.classList.remove('bg-transparent', 'text-slate-600');
        }
    }
    filterUsers('all');
</script>
@endpush