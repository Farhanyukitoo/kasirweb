<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pelanggan;
use App\Models\Penjualan;


class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total produk
        $totalProducts = Product::count();
        
        // Hitung total pelanggan
        $totalPelanggan = Pelanggan::count();

        // Hitung total penjualan
        $totalPenjualan = Penjualan::count();

        // Hitung total detail penjualan
        $totalDetail = DetailPenjualan::count();

        // Ambil Salah satu field yang ada di table product
        $totalStock = Product::sum('stock'); 

        $totalProducts = Product::count(); // Menghitung total produk
        $totalPelanggan = Pelanggan::count(); // Menghitung total pelanggan
        $totalPenjualan = Penjualan::count(); // Menghitung total transaksi penjualan
        $totalDetail = DetailPenjualan::count(); // Menghitung total detail transaksi
        $totalStock = Product::sum('stock'); // Menjumlahkan seluruh stok produk

        return view('dashboard.index', compact('totalProducts', 'totalPelanggan', 'totalPenjualan', 'totalDetail', 'totalStock'));
    
        $totalPenjualan = Penjualan::count();
        $totalPendapatan = Penjualan::sum('totalharga');
        $totalProduk = Product::count();
        
        return view('dashboard', compact('totalPenjualan', 'totalPendapatan', 'totalProduk'));
        // return view('dashboard.index', compact('totalProducts', 'totalPelanggan', 'totalPenjualan', 'totalDetail', 'totalStock'));
    }
    
    public function getStockData()
{
    // Mengambil data stok terbaru dari database
    $stockData = Product::select('name', 'stock')->get();

    return response()->json($stockData);
}


}
