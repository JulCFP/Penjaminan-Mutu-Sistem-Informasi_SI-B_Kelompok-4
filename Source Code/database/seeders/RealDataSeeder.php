<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Penjual;
use App\Models\Produk;

class RealDataSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================================
        // DATA MASTER TOKO & PRODUK (Berdasarkan File Upload)
        // ==========================================================
        $shops = [
            [
                'name' => 'Toko Sayur Segar Lestari',
                'email' => 'lestari@gmail.com',
                'phone' => '081200000001',
                'products' => [
                    ['name' => 'Bayam', 'price' => 3000, 'img' => 'Haritani/Toko Sayur Segar Lestari/bayam.jpg'],
                    ['name' => 'Kangkung', 'price' => 3000, 'img' => 'Haritani/Toko Sayur Segar Lestari/kangkung.jpg'],
                    ['name' => 'Sawi Hijau', 'price' => 4000, 'img' => 'Haritani/Toko Sayur Segar Lestari/sawi hijau.jpg'],
                    ['name' => 'Buncis', 'price' => 8000, 'img' => 'Haritani/Toko Sayur Segar Lestari/buncis.jpg'],
                    ['name' => 'Wortel', 'price' => 12000, 'img' => 'Haritani/Toko Sayur Segar Lestari/wortel.jpg'],
                    // Koreksi: Berdasarkan file, gambar tomat.jpg isinya kentang
                    ['name' => 'Kentang', 'price' => 15000, 'img' => 'Haritani/Toko Sayur Segar Lestari/tomat.jpg'], 
                    // Koreksi: Gambar tomat asli yang kode acak
                    ['name' => 'Tomat', 'price' => 10000, 'img' => 'Haritani/Toko Sayur Segar Lestari/3c2d51821c34ce58b56bd429ed7abac9.jpg'],
                ]
            ],
            [
                'name' => 'Kebun Hijau Nusantara',
                'email' => 'nusantara@gmail.com',
                'phone' => '081200000002',
                'products' => [
                    ['name' => 'Brokoli', 'price' => 25000, 'img' => 'Haritani/Kebun Hijau Nusantara/brokoli.jpg'],
                    ['name' => 'Kembang Kol', 'price' => 22000, 'img' => 'Haritani/Kebun Hijau Nusantara/kembang kol.jpg'],
                    ['name' => 'Selada', 'price' => 5000, 'img' => 'Haritani/Kebun Hijau Nusantara/selada.jpg'],
                    ['name' => 'Paprika', 'price' => 30000, 'img' => 'Haritani/Kebun Hijau Nusantara/paprika.jpg'],
                    ['name' => 'Mentimun', 'price' => 6000, 'img' => 'Haritani/Kebun Hijau Nusantara/Mentimun.jpg'],
                    ['name' => 'Tomat Cherry', 'price' => 18000, 'img' => 'Haritani/Kebun Hijau Nusantara/tomat cherry.jpg'],
                ]
            ],
            [
                'name' => 'Toko Panen Pagi',
                'email' => 'panenpagi@gmail.com',
                'phone' => '081200000003',
                'products' => [
                    ['name' => 'Timun', 'price' => 5000, 'img' => 'Haritani/Toko Panen Pagi/Timun.jpg'],
                    ['name' => 'Oyong / Gambas', 'price' => 7000, 'img' => 'Haritani/Toko Panen Pagi/Gambas.jpg'],
                    ['name' => 'Pare', 'price' => 6000, 'img' => 'Haritani/Toko Panen Pagi/Pare.jpg'],
                    ['name' => 'Daun Singkong', 'price' => 2500, 'img' => 'Haritani/Toko Panen Pagi/Daun Singkong.jpg'],
                    ['name' => 'Daun Pepaya', 'price' => 2500, 'img' => 'Haritani/Toko Panen Pagi/daun pepaya.jpg'],
                    ['name' => 'Genjer', 'price' => 3000, 'img' => null], // Gambar tidak ditemukan
                ]
            ],
            [
                'name' => 'Dapur Organik Pak Wira',
                'email' => 'pakwira@gmail.com',
                'phone' => '081200000004',
                'products' => [
                    ['name' => 'Kale', 'price' => 35000, 'img' => 'Haritani/Dapur Organik Pak Wira/Kale.jpg'],
                    ['name' => 'Zucchini', 'price' => 15000, 'img' => 'Haritani/Dapur Organik Pak Wira/Zucchini.jpg'],
                    ['name' => 'Lettuce Romaine', 'price' => 12000, 'img' => 'Haritani/Dapur Organik Pak Wira/Lettuce Romaine.jpg'],
                    ['name' => 'Jagung Manis', 'price' => 9000, 'img' => 'Haritani/Dapur Organik Pak Wira/Jagung manis.jpg'],
                ]
            ],
            [
                'name' => 'FreshFarm Bu Tini',
                'email' => 'butini@gmail.com',
                'phone' => '081200000005',
                'products' => [
                    ['name' => 'Cabai Merah', 'price' => 45000, 'img' => 'Haritani/FreshFarm Bu Tini/Cabai Merah.jpg'],
                    ['name' => 'Cabai Rawit', 'price' => 55000, 'img' => 'Haritani/FreshFarm Bu Tini/Cabai Rawit.jpg'],
                    // Koreksi: File 'bawang putih.jpg' isinya Bawang Merah
                    ['name' => 'Bawang Merah', 'price' => 30000, 'img' => 'Haritani/FreshFarm Bu Tini/bawang putih.jpg'],
                    // Koreksi: File kode acak isinya Bawang Putih
                    ['name' => 'Bawang Putih', 'price' => 32000, 'img' => 'Haritani/FreshFarm Bu Tini/c3f053c5b0bb30dd9d1421d52fde5a3c.jpg'],
                    ['name' => 'Daun Sop (Seledri)', 'price' => 4000, 'img' => 'Haritani/FreshFarm Bu Tini/daun seledri.jpg'],
                    ['name' => 'Daun Bawang', 'price' => 4000, 'img' => 'Haritani/FreshFarm Bu Tini/daun bawang.jpg'],
                ]
            ],
            [
                'name' => 'AgroFresh Sejati',
                'email' => 'agrofresh@gmail.com',
                'phone' => '081200000006',
                'products' => [
                    ['name' => 'Paprika Merah', 'price' => 35000, 'img' => 'Haritani/AgroFresh Sejati/Paprika Merah.jpg'],
                    ['name' => 'Paprika Hijau', 'price' => 30000, 'img' => 'Haritani/AgroFresh Sejati/Paprika Hijau.jpg'],
                    ['name' => 'Tomat', 'price' => 11000, 'img' => 'Haritani/AgroFresh Sejati/Tomat.jpg'],
                    ['name' => 'Cabai Hijau', 'price' => 25000, 'img' => 'Haritani/AgroFresh Sejati/Cabai Hijau.jpg'],
                    ['name' => 'Kentang', 'price' => 16000, 'img' => 'Haritani/AgroFresh Sejati/Kentang.jpg'],
                    ['name' => 'Wortel', 'price' => 13000, 'img' => 'Haritani/AgroFresh Sejati/Wortel.jpg'],
                ]
            ],
            [
                'name' => 'SayurMakmur.ID',
                'email' => 'sayurmakmur@gmail.com',
                'phone' => '081200000007',
                'products' => [
                    ['name' => 'Tomat', 'price' => 10000, 'img' => 'Haritani/SayurMakmur.ID/Tomat.jpg'],
                    ['name' => 'Kentang', 'price' => 15000, 'img' => 'Haritani/SayurMakmur.ID/Kentang.jpg'],
                    ['name' => 'Wortel', 'price' => 12000, 'img' => 'Haritani/SayurMakmur.ID/Wortel.jpg'],
                    ['name' => 'Terong Ungu', 'price' => 8000, 'img' => 'Haritani/SayurMakmur.ID/Terong Ungu.jpg'],
                    ['name' => 'Labu Siam', 'price' => 4000, 'img' => 'Haritani/SayurMakmur.ID/Labu siam.jpg'],
                    ['name' => 'Kacang Panjang', 'price' => 6000, 'img' => 'Haritani/SayurMakmur.ID/Kacang Panjang.jpg'],
                ]
            ],
        ];

        // ==========================================================
        // EKSEKUSI
        // ==========================================================
        foreach ($shops as $shopData) {
            // 1. Buat Akun Penjual
            $penjual = Penjual::create([
                'nama_penjual' => $shopData['name'],
                'email' => $shopData['email'],
                'password' => Hash::make('password'), // Password default semua toko: password
                'no_telepon' => $shopData['phone'],
                'alamat' => 'Alamat ' . $shopData['name'],
            ]);

            // 2. Buat Produk untuk Penjual Tersebut
            foreach ($shopData['products'] as $prod) {
                Produk::create([
                    'id_penjual' => $penjual->id_penjual,
                    'nama_produk' => $prod['name'],
                    'harga' => $prod['price'],
                    'stok' => rand(10, 50), // Stok acak 10-50
                    'deskripsi' => 'Sayuran segar berkualitas dari ' . $shopData['name'],
                    'gambar' => $prod['img'], 
                ]);
            }
        }
    }
}