<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_penjual',
        'periode',
        'total_penjualan',
        'jumlah_transaksi',
    ];

    // Relasi: Laporan dimiliki oleh Penjual
    public function penjual()
    {
        return $this->belongsTo(Penjual::class, 'id_penjual');
    }
}
