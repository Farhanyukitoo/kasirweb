<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    /**
     * Menampilkan daftar detail penjualan.
     */
    public function index()
    {
        $details = DetailPenjualan::with(['penjualan', 'product'])->get();
        return view('detail_penjualans.index', compact('details'));
    }

    /**
     * Menampilkan form untuk membuat detail penjualan baru.
     */
    public function create()
    {
        $penjualans = Penjualan::all();
        $products = Product::all();
        return view('detail_penjualans.create', compact('penjualans', 'products'));

    }

    /**
     * Menyimpan detail penjualan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'produk_id' => 'required|exists:products,id',
            'jumlahproduk' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);
    
        // Validasi tambahan
        $product = Product::findOrFail($request->produk_id);
        if ($request->jumlahproduk > $product->stock) {
            return redirect()->back()->withErrors(['jumlahproduk' => 'Jumlah produk melebihi stok yang tersedia.']);
        }
    
        $request->merge([
            'subtotal' => $request->jumlahproduk * $product->price,
        ]);
    
        DetailPenjualan::create($request->all());
        return redirect()->route('detail-penjualans.index')->with('success', 'Detail penjualan berhasil ditambahkan.');
    }
    
    /**
     * Menampilkan detail penjualan tertentu.
     */
    public function show(DetailPenjualan $detailPenjualan)
    {
        return view('detail_penjualans.show', compact('detailPenjualan'));
    }

    /**
     * Menampilkan form untuk mengedit detail penjualan.
     */
    public function edit(DetailPenjualan $detailPenjualan)
    {
        $penjualans = Penjualan::all();
        $products = Product::all();
        return view('detail_penjualans.edit', compact('detailPenjualan', 'penjualans', 'products'));
    }

    /**
     * Memperbarui detail penjualan di database.
     */
    public function update(Request $request, DetailPenjualan $detailPenjualan)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'produk_id' => 'required|exists:products,id',
            'jumlahproduk' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $detailPenjualan->update($request->all());
        return redirect()->route('detail-penjualans.index')->with('success', 'Detail penjualan berhasil diperbarui.');
    }

    /**
     * Menghapus detail penjualan dari database.
     */
    public function destroy(DetailPenjualan $detailPenjualan)
    {
        $detailPenjualan->delete();
        return redirect()->route('detail-penjualans.index')->with('success', 'Detail penjualan berhasil dihapus.');
    }
}
