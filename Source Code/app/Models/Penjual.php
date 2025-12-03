<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Penjual extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'penjual';
    protected $primaryKey = 'id_penjual';

    protected $fillable = [
        'nama_penjual',
        'alamat',
        'no_telepon',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: Penjual memiliki banyak Produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_penjual');
    }

    // Relasi: Penjual memiliki banyak Laporan
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_penjual');
    }
}
