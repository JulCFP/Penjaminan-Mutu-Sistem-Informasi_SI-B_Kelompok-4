<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_penjual',
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'gambar'
    ];

    // Produk dimiliki oleh Penjual
    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'id_penjual');
    }

    // Produk memiliki detail pesanan
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_produk');
    }
}
