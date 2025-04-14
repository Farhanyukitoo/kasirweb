<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'penjualans';


    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'Tanggalpenjualan',
        'totalharga',
        'Peran',
        'pelanggan_id',
        'product_id' // Here you are using 'pelangganID'
    ];

    // Relasi Many to One dengan tabel Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    // Jika primary key bukan auto-increment atau tipe integer
    public $incrementing = true;
    protected $keyType = 'int';

    // Atur timestamps jika tidak digunakan
    public $timestamps = true; // Ubah ke false jika tidak menggunakan created_at dan updated_at

    // Override boot method untuk memperbarui laporan setiap ada transaksi baru
    protected static function boot()
    {
        parent::boot();

        static::created(function ($penjualan) {
            $laporan = Laporan::firstOrCreate([]);

            // Tambah total produk terjual dan pendapatan
            $laporan->increment('total_produk_terjual');
            $laporan->increment('total_pendapatan', $penjualan->totalharga);
        });
    }
}