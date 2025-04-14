<?php

// app/Http/Controllers/PenjualanController.php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Product;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Menampilkan daftar penjualan dengan pagination
        $penjualans = Penjualan::paginate(10); // 10 adalah jumlah item per halaman
        return view('penjualans.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $pelanggans = Pelanggan::all();
        return view('penjualans.create', compact('products', 'pelanggans'));
    }

    /**
     * Store a newly create d resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'Tanggalpenjualan' => ['required', 'date', function ($attribute, $value, $fail) {
                if (strtotime($value) < strtotime(date('Y-m-d'))) {
                    $fail('Tanggal penjualan tidak boleh kurang dari hari ini.');
                }
            }],
            'totalharga' => 'required|array', // Ensure totalharga is an array
            'totalharga.*' => 'required|numeric', // Each item in totalharga must be numeric
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'product_id' => 'required|array', // product_id should be an array
            'product_id.*' => 'required|exists:products,id' // Each product_id must be valid
        ]);
    
        // Variable to track total sale price
        $totalHargaAkhir = 0;
        
        // Loop through the selected products
        foreach ($request->product_id as $index => $productId) {
            $product = Product::findOrFail($productId);
            $productPrice = $product->price;
            $quantitySold = $request->quantity[$index]; // Assuming you send quantity in the request
    
            // Validate if enough stock is available
            if ($product->stock < $quantitySold) {
                return redirect()->route('penjualans.index')->with('error', 'Stok tidak cukup untuk produk: ' . $product->name);
            }
    
            // Deduct stock based on the quantity sold
            $product->stock -= $quantitySold;
            $product->save();
    
            // Update total sale price
            $totalHargaAkhir += $productPrice * $quantitySold;
        }
    
        // Insert new sale into the database
        Penjualan::create([
            'Tanggalpenjualan' => $request->Tanggalpenjualan,
            'totalharga' => $totalHargaAkhir,
            'pelanggan_id' => $request->pelanggan_id,
            'product_id' => $request->product_id[0] // Assuming the first product is selected for this sale
        ]);
    
        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }    


    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $penjualan = Penjualan::findOrFail($id);
    return view('penjualans.show', compact('penjualan'));
}

    // public function show($id)
    // {
    //     $penjualan = Penjualan::findOrFail($id);
    //     $products = Product::all();
    //     $pelanggans = Pelanggan::all();
    //     // Menampilkan detail penjualan
    //     return view('penjualans.show', compact('penjualan','products', 'pelanggans'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil penjualan bersama pelanggan
        $penjualan = Penjualan::findOrFail($id);
        $products = Product::all();
        // Mendapatkan daftar pelanggan untuk dipilih
        $pelanggans = Pelanggan::all();
        
        // Mengembalikan ke view edit
        return view('penjualans.edit', compact('penjualan', 'pelanggans','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        // Validasi data
        $request->validate([
            'Tanggalpenjualan' => ['required', 'date', function ($attribute, $value, $fail) {
                if (strtotime($value) < strtotime(date('Y-m-d'))) {
                    $fail('Tanggal penjualan tidak boleh kurang dari hari ini.');
                }
            }],
            'totalharga' => 'required|numeric',
            'pelanggan_id' => 'required|exists:pelanggans,id', // Perbaiki di sini
            'product_id' => 'required|exists:products,id'
        ]);

        // Memperbarui data penjualan
        $penjualan->update($request->all());

        // Redirect ke halaman daftar penjualan
        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        // Menghapus data penjualan
        $penjualan->delete();

        // Redirect ke halaman daftar penjualan
        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil dihapus.');
    }

    
}
