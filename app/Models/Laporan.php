<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans'; // Pastikan nama tabel sesuai dengan migrasi

    protected $fillable = [
        'total_produk_terjual',
        'total_pendapatan',
        'total_produk_tersedia',
    ];

    // Opsional: Tambahkan casts untuk memastikan data diproses dengan benar
    protected $casts = [
        'total_produk_terjual' => 'integer',
        'total_pendapatan' => 'decimal:2',
        'total_produk_tersedia' => 'integer',
    ];
}
