<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Konsumen extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'konsumen';
    protected $primaryKey = 'id_konsumen';

    protected $fillable = [
        'nama_konsumen',
        'alamat',
        'no_telepon',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: Konsumen memiliki banyak Pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_konsumen');
    }
}
