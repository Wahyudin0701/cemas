<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Penjual;
use App\Models\Toko;
use App\Models\Produk;
use App\Models\Pembeli;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Enums\UserRole;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ==========================================
        // 1. DATA PENJUAL & TOKO
        // ==========================================
        $sellers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'penjual@gmail.com',
                'nama_toko' => 'Toko Budi Jaya',
                'deskripsi' => 'Menjual berbagai kebutuhan sehari-hari dengan harga terjangkau.',
                'lokasi' => 'Jl. Kebon Jeruk No. 12, Jakarta Barat',
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.toko@gmail.com',
                'nama_toko' => 'Aminah Collection',
                'deskripsi' => 'Pusat fashion muslim kekinian dan berkualitas.',
                'lokasi' => 'Jl. Braga No. 45, Bandung',
            ],
            [
                'name' => 'Andi Pratama',
                'email' => 'andi.elektronik@gmail.com',
                'nama_toko' => 'Andi Elektronik',
                'deskripsi' => 'Gadget, laptop, dan aksesoris original bergaransi.',
                'lokasi' => 'Mangga Dua Square Blok A, Jakarta',
            ],
        ];

        $tokoIds = [];

        foreach ($sellers as $index => $sellerData) {
            $user = User::create([
                'name' => $sellerData['name'],
                'email' => $sellerData['email'],
                'password' => Hash::make('password'),
                'role' => UserRole::Penjual,
                'is_active' => true,
            ]);

            $penjual = Penjual::create([
                'user_id' => $user->id,
                'phone' => $faker->phoneNumber,
                'alamat' => $sellerData['lokasi'],
                'nik' => $faker->numerify('################'), // 16 digit NIK
            ]);

            $toko = Toko::create([
                'penjual_id' => $penjual->id,
                'nama_toko' => $sellerData['nama_toko'],
                'deskripsi_toko' => $sellerData['deskripsi'],
                'foto_toko' => null, // Placeholder or null
                'jam_buka' => '08:00',
                'jam_tutup' => '21:00',
                'lokasi' => $sellerData['lokasi'],
                'status_verifikasi' => 'Terverifikasi',
            ]);

            $tokoIds[] = $toko->id;

            // ==========================================
            // 2. DATA PRODUK UNTUK TOKO INI
            // ==========================================
            for ($i = 1; $i <= rand(5, 10); $i++) {
                Produk::create([
                    'toko_id' => $toko->id,
                    'nama_produk' => ucwords($faker->words(3, true)) . ' Kualitas Terbaik',
                    'deskripsi' => $faker->paragraph(2),
                    'harga' => $faker->numberBetween(10, 500) * 1000,
                    'stok' => $faker->numberBetween(5, 50),
                    'foto_produk' => null,
                ]);
            }
        }

        // ==========================================
        // 3. DATA PEMBELI & KERANJANG
        // ==========================================
        $buyers = [
            [
                'name' => 'Rina Melati',
                'email' => 'pembeli@gmail.com',
                'address' => 'Jl. Sudirman No. 8, Jakarta Selatan',
            ],
            [
                'name' => 'Dwi Saputra',
                'email' => 'dwisaputra@gmail.com',
                'address' => 'Jl. Pahlawan No. 22, Surabaya',
            ],
        ];

        $pembeliIds = [];

        foreach ($buyers as $buyerData) {
            $user = User::create([
                'name' => $buyerData['name'],
                'email' => $buyerData['email'],
                'password' => Hash::make('password'),
                'role' => UserRole::Pembeli,
                'is_active' => true,
            ]);

            $pembeli = Pembeli::create([
                'user_id' => $user->id,
                'phone' => $faker->phoneNumber,
                'alamat' => $buyerData['address'],
            ]);

            Keranjang::create([
                'pembeli_id' => $pembeli->id,
                'toko_id' => $tokoIds[array_rand($tokoIds)],
            ]);

            $pembeliIds[] = $pembeli->id;
        }

        // ==========================================
        // 4. DATA PESANAN (TRANSAKSI)
        // ==========================================
        $statuses = [
            'Menunggu Konfirmasi',
            'Dikonfirmasi/Diproses',
            'Siap Diambil/Diantar',
            'Selesai',
            'Dibatalkan'
        ];

        // Buat 10 pesanan dummy
        for ($i = 0; $i < 15; $i++) {
            $tokoId = $tokoIds[array_rand($tokoIds)];
            $pembeliId = $pembeliIds[array_rand($pembeliIds)];
            $status = $statuses[array_rand($statuses)];
            
            // Ambil 1-3 produk secara random dari toko tersebut
            $produkList = Produk::where('toko_id', $tokoId)->inRandomOrder()->limit(rand(1, 3))->get();
            
            if ($produkList->isEmpty()) continue;

            $totalHarga = 0;
            
            $pesanan = Pesanan::create([
                'pembeli_id' => $pembeliId,
                'toko_id' => $tokoId,
                'total_harga_final' => 0, // Akan di-update nanti
                'status_pesanan' => $status,
                'catatan_pembeli' => $faker->boolean(50) ? 'Tolong packing aman ya.' : null,
                'metode_pengambilan' => $faker->randomElement(['Ambil di Toko', 'Diantar', 'Kirim via Kurir']),
                'tanggal_pesanan' => Carbon::now()->subDays(rand(1, 10)),
            ]);

            foreach ($produkList as $produk) {
                $qty = rand(1, 3);
                $subtotal = $produk->harga * $qty;
                $totalHarga += $subtotal;

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'toko_id' => $tokoId,
                    'produk_id' => $produk->id,
                    'kuantitas' => $qty,
                    'harga_saat_pesan' => $produk->harga,
                ]);
            }

            // Update total harga
            $pesanan->update(['total_harga_final' => $totalHarga]);
        }
    }
}
