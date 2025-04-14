<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'pelanggans';


    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'namapelanggan',
        'Alamat',
        'Nomer',
        'Peran',
        'Nomerunik', // Tambahkan kolom Nomerunik

        
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    // Jika primary key bukan auto-increment atau tipe integer
    public $incrementing = true;
    protected $keyType = 'int';

    // Atur timestamps jika tidak digunakan
    public $timestamps = true; // Ubah ke false jika tidak menggunakan created_at dan updated_at
}
