<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{

    $search = $request->input('search');
    $peran = $request->input('peran'); // Get the selected Peran filter

    // Query builder
    $query = Pelanggan::query();

    // Apply search filter if any
    if ($search) {
        $query->where('namapelanggan', 'like', "%{$search}%")
              ->orWhere('Nomer', 'like', "%{$search}%");
    }

    // Apply peran filter if any
    if ($peran) {
        $query->where('Peran', $peran);
    }

    // Paginate the results
    $pelanggans = $query->paginate(10)->appends(['search' => $search, 'peran' => $peran]);

    return view('pelanggans.index', compact('pelanggans', 'search', 'peran'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat pelanggan baru
        return view('pelanggans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'namapelanggan' => 'required|string|max:100',
            'Peran' => 'required|string',
            'Alamat' => 'required|string',
            'Nomer' => 'required|string|max:15',
            'Nomerunik' => 'required|numeric|unique:pelanggans,Nomerunik',
        ], [
            'Nomerunik.unique' => 'Nomorunik sudah digunakan, silakan coba yang lain, pastikan Nomerunik sesuai yang di kartu anda.',
        ]);

        // Menyimpan data pelanggan
        Pelanggan::create($request->all());

        // Redirect ke halaman daftar pelanggan
        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Menampilkan detail pelanggan
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggans.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        // Menampilkan form untuk mengedit data pelanggan
        return view('pelanggans.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        // Validasi data
        $request->validate([
            'namapelanggan' => 'required|string|max:100',
            'Alamat' => 'required|string',
            'Nomer' => 'required|string|max:15',
            'Peran' => 'required|string',
            'Nomerunik' => 'required|numeric|unique:pelanggans,Nomerunik',
        ], [
            'Nomerunik.unique' => 'Nomorunik sudah digunakan, silakan coba yang lain, pastikan Nomerunik sesuai yang di kartu anda.',
        ]);

        // Memperbarui data pelanggan
        $pelanggan->update($request->all());

        // Redirect ke halaman daftar pelanggan
        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        // Menghapus data pelanggan
        $pelanggan->delete();

        // Redirect ke halaman daftar pelanggan
        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil dihapus.');
    }


}
