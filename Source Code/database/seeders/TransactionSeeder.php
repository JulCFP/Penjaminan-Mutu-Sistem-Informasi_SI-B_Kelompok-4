<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Konsumen;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Penjual;
use App\Models\Laporan;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. BUAT AKUN KONSUMEN (PEMBELI)
        // ==========================================
        $konsumenData = [
            [
                'nama_konsumen' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'no_telepon' => '08210000001',
                'alamat' => 'Jl. Merpati No. 1, Palu',
                'password' => Hash::make('password'),
            ],
            [
                'nama_konsumen' => 'Siti Aminah',
                'email' => 'siti@gmail.com',
                'no_telepon' => '08210000002',
                'alamat' => 'Jl. Elang No. 5, Palu',
                'password' => Hash::make('password'),
            ],
            [
                'nama_konsumen' => 'Rahmat Hidayat',
                'email' => 'rahmat@gmail.com',
                'no_telepon' => '08210000003',
                'alamat' => 'Jl. Kakatua No. 10, Palu',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($konsumenData as $k) {
            Konsumen::firstOrCreate(['email' => $k['email']], $k);
        }

        // ==========================================
        // 2. SIMULASI TRANSAKSI (PESANAN)
        // ==========================================
        
        // Ambil semua konsumen dan produk yang ada
        $allKonsumen = Konsumen::all();
        $allProduk = Produk::all();

        if ($allProduk->isEmpty()) {
            $this->command->info('Produk kosong. Jalankan RealDataSeeder dulu!');
            return;
        }

        // Kita buat 15 Transaksi acak
        for ($i = 0; $i < 15; $i++) {
            $pembeli = $allKonsumen->random(); // Pilih pembeli acak
            
            // Buat Header Pesanan
            $pesanan = Pesanan::create([
                'id_konsumen' => $pembeli->id_konsumen,
                'tanggal_pesan' => Carbon::now()->subDays(rand(1, 30)), // Tanggal acak 1-30 hari lalu
                'status_pesanan' => 'Selesai', // Anggap semua sudah selesai
                'alamat_pengiriman' => $pembeli->alamat,
                'total_harga' => 0, // Nanti diupdate
            ]);

            $totalBelanja = 0;
            
            // Konsumen beli 1-3 jenis produk per transaksi
            $jumlahJenisProduk = rand(1, 3);
            $produkDibeli = $allProduk->random($jumlahJenisProduk);

            foreach ($produkDibeli as $produk) {
                $qty = rand(1, 3); // Beli 1-3 pcs
                $subtotal = $produk->harga * $qty;
                
                DetailPesanan::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'id_produk' => $produk->id_produk,
                    'jumlah' => $qty,
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $subtotal
                ]);

                $totalBelanja += $subtotal;
            }

            // Update Total Harga Pesanan
            $pesanan->update(['total_harga' => $totalBelanja]);

            // Buat Data Pembayaran (Lunas)
            Pembayaran::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'metode_pembayaran' => 'Transfer Bank',
                'bukti_pembayaran' => 'bukti-dummy.jpg', // Placeholder
                'tanggal_pembayaran' => $pesanan->tanggal_pesan,
                'status_pembayaran' => 'Lunas',
            ]);
        }

        // ==========================================
        // 3. GENERATE LAPORAN PENJUAL
        // ==========================================
        $allPenjual = Penjual::all();

        foreach ($allPenjual as $penjual) {
            // Hitung total penjualan real dari tabel detail_pesanan
            // (Query: cari detail pesanan yg produknya milik penjual ini)
            $totalOmset = DetailPesanan::whereHas('produk', function($q) use ($penjual) {
                $q->where('id_penjual', $penjual->id_penjual);
            })->sum('subtotal');

            $jumlahTransaksi = Pesanan::whereHas('detailPesanan.produk', function($q) use ($penjual) {
                $q->where('id_penjual', $penjual->id_penjual);
            })->count();

            if ($totalOmset > 0) {
                Laporan::create([
                    'id_penjual' => $penjual->id_penjual,
                    'periode' => Carbon::now()->format('F Y'), // Bulan ini
                    'total_penjualan' => $totalOmset,
                    'jumlah_transaksi' => $jumlahTransaksi,
                ]);
            }
        }
    }
}