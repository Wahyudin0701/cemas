@extends(Auth::user()->role->value === 'admin' ? 'layouts.admin' : (Auth::user()->role->value === 'penjual' ? 'layouts.penjual' : 'layouts.pembeli'))

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10 fade-in">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Pengaturan Akun</h2>
            <p class="text-gray-600 mt-2">
                Kelola informasi profil dan keamanan akun Anda.
            </p>
        </div>
        
        <div class="mt-4 md:mt-0">
             <span class="inline-flex items-center px-2 py-2 rounded-lg text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                {{ ucfirst(Auth::user()->role->value) }}
             </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- UPDATE PROFILE INFO -->
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg mr-3 text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                Informasi Pribadi
            </h3>
            
            <div class="mt-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- UPDATE PASSWORD -->
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
             <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg mr-3 text-yellow-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                Keamanan Password
            </h3>

            <div class="mt-4">
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
