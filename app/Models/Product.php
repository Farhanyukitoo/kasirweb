<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menambahkan kolom yang dapat diisi secara massal
    protected $fillable = [
        'name', 
        'price', 
        'stock', 
        'image'
    ];  

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Validasi stock tidak boleh negatif sebelum disimpan
        static::saving(function ($product) {
            if ($product->stock < 0) {
                throw new \Exception('Stock cannot be negative');
            }
        });

        // Update laporan stok setelah produk diperbarui
        static::updated(function ($product) {
            $laporan = Laporan::firstOrCreate([]);

            // Update stok tersedia di laporan
            $laporan->update([
                'total_produk_tersedia' => Product::sum('stock'),
            ]);
        });
    }
}

