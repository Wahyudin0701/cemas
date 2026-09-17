@extends(Auth::user()->role->value === 'admin' ? 'layouts.admin' : (Auth::user()->role->value === 'penjual' ? 'layouts.penjual' : 'layouts.pembeli'))

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10 lg:py-16 fade-in">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
        <div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Pengaturan Akun</h2>
            <p class="text-slate-500 mt-2 text-lg">
                Kelola informasi profil dan keamanan akun Anda.
            </p>
        </div>
        
        <div class="mt-4 md:mt-0">
             <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-primary-50 text-primary-700 border border-primary-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                {{ ucfirst(Auth::user()->role->value) }}
             </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- UPDATE PROFILE INFO -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200/60 hover:shadow-lg transition-shadow duration-300">
            <h3 class="text-2xl font-bold text-slate-800 mb-8 flex items-center">
                <div class="p-3 bg-primary-100 rounded-xl mr-4 text-primary-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                Informasi Pribadi
            </h3>
            
            <div>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- UPDATE PASSWORD -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200/60 hover:shadow-lg transition-shadow duration-300">
             <h3 class="text-2xl font-bold text-slate-800 mb-8 flex items-center">
                <div class="p-3 bg-amber-100 rounded-xl mr-4 text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                Keamanan Password
            </h3>

            <div>
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        document.querySelectorAll('.fade-in').forEach(el => el.classList.add('show'));
    }, 100);
</script>
@endsection
