<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Penjual;
use App\Models\Pembeli;
use App\Models\Toko; // Diperlukan untuk Penjual

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminUser = User::create([
            'name' => 'Admin RT Cemas',
            'email' => 'admin@rt.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
        ]);
        $this->command->info('Akun Admin (admin@rt.com) berhasil dibuat.');
    }
}
