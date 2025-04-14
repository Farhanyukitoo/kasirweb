<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar untuk mengambil produk
        $products = Product::orderBy('stock', 'desc') // Urutkan berdasarkan stok (terbanyak)
            ->orderBy('price', 'asc'); // Jika stok sama, urutkan berdasarkan harga (termurah)

        // Hitung total stok semua produk
        $totalStock = Product::sum('stock');

        // Hitung total harga semua produk
        $totalPrice = Product::sum('price');

        // Filter berdasarkan harga
        if ($request->has('price_range')) {
            switch ($request->price_range) {
                case '0-50000':
                    $products->where('price', '<=', 50000);
                    break;
                case '0-100000':
                    $products->where('price', '<=', 100000);
                    break;
                case '100001-500000':
                    $products->whereBetween('price', [100001, 500000]);
                    break;
                case '500001+':
                    $products->where('price', '>=', 500001);
                    break;
            }
        }

        // Filter berdasarkan stok
        if ($request->has('stock_range')) {
            switch ($request->stock_range) {
                case '1-3':
                    $products->whereBetween('stock', [1, 3]);
                    break;
                case '4-6':
                    $products->whereBetween('stock', [4, 6]);
                    break;
                case '7-11':
                    $products->whereBetween('stock', [7, 11]);
                    break;
            }
        }

        // Eksekusi query
        $products = $products->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
        $product->save();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0', // Allowing positive numbers only
            'stock' => 'required|integer|min:0', // Batas maksimal 11
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', //Di Sarnkan Format PNG
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $validated['price'] = number_format($validated['price'], 2, '.', '');

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imageName,
        ]);

        // return redirect()->route('products.index');
        // Product::create($request->all());    
        return redirect()->route('products.index')->with('success', 'Product Create successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function show(Product $product)
    {
        // Menampilkan detail pelanggan
        return view('products.show', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', //Di Sarnkan Format PNG
        ]);

        // Simpan data produk
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;

        // Tangani gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }

            // Upload gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Delete successfully.');
    }
}
