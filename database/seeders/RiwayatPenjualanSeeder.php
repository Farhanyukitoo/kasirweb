<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatPenjualan;

class RiwayatPenjualanSeeder extends Seeder
{
    public function run()
    {
        RiwayatPenjualan::factory(10)->create();
    }
}
