<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenjualan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penjualan';
    
    protected $fillable = [
        'kode_transaksi',
        'tanggal_transaksi',
        'total_harga',
        'metode_pembayaran',
        'status'
    ];
}
