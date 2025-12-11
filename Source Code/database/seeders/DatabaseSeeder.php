<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,        // Admin Utama
            RealDataSeeder::class,    // Penjual & Produk (Data Asli)
            TransactionSeeder::class, // Konsumen, Pesanan, Pembayaran (Simulasi)
        ]);
    }
}