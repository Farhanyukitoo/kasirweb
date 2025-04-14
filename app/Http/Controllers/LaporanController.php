<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Product;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Query penjualan dengan filter tanggal jika tersedia
        $query = Penjualan::with(['pelanggan', 'product']);
        
        if ($start_date && $end_date) {
            $query->whereBetween('Tanggalpenjualan', [$start_date, $end_date]);
        }

        $penjualans = $query->get();
        $products = Product::all();
        $laporan = Laporan::first();

        return view('laporan.index', compact('laporan', 'penjualans', 'products', 'start_date', 'end_date'));
    }

    public function cetakPDF(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Query penjualan berdasarkan periode tanggal
        $query = Penjualan::with(['pelanggan', 'product']);
        
        if ($start_date && $end_date) {
            $query->whereBetween('Tanggalpenjualan', [$start_date, $end_date]);
        }

        $penjualans = $query->get();
        $products = Product::all();

        $pdf = Pdf::loadView('laporan.pdf', compact('products', 'penjualans', 'start_date', 'end_date'));

        return $pdf->download('Laporan_Penjualan_' . date('Ymd') . '.pdf');
    }
}
