<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penjualan</title>
    <link rel="stylesheet" href="{{ asset('css/indexpenjualan.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alert = document.querySelector('.alert-success');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = 0;
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            }
        });
    </script>
</head>
@extends('layouts.app')
@section('title', 'Daftar Penjualan')

@section('content')

<body>
    <div class="container">
        <h1 class="text-center"><i class="bi bi-cart-check"></i> Daftar Penjualan</h1>

        <!-- Alert Success
        @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif -->

        <div class="jrk">

        </div>
        <!-- Tabel Penjualan -->
        <div class="table-container">

            <!-- Tombol Tambah Penjualan -->
            <div class="d-flex">
                <a href="{{ route('penjualans.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah Penjualan
                </a>
            </div>

            <div class="jrk">

            </div>
            <table>
                <thead>
                    <tr>
                        <th><i class="bi bi-list-ol"></i> No</th>
                        <th><i class="bi bi-calendar-check"></i> Tanggal Penjualan</th>
                        <th><i class="bi bi-cash-coin"></i> Total Harga</th>
                        <th><i class="bi bi-person"></i> Pelanggan</th>
                        <th><i class="bi bi-box-seam"></i> Nama Produk</th>
                        <th><i class="bi bi-tags"></i> Harga Produk</th>
                        <th><i class="bi bi-archive"></i> Jumlah Stok</th>
                        <th><i class="bi bi-tools"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualans as $penjualan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penjualan->Tanggalpenjualan }}</td>
                        <td>Rp{{ number_format($penjualan->totalharga, 2, ',', '.') }}</td>
                        <td>{{ $penjualan->pelanggan->namapelanggan }} - {{ $penjualan->pelanggan->Peran }}</td>
                        <td>{{ $penjualan->product->name }}</td>
                        <td>Rp{{ number_format($penjualan->product->price, 2, ',', '.') }}</td>
                        <td>{{ $penjualan->product->stock }}</td>
                        <td>
                            <a href="{{ route('penjualans.show', $penjualan->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-receipt"></i> Struk
                            </a>

                            <form action="{{ route('penjualans.destroy', $penjualan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                @if(auth()->user() && auth()->user()->role === 'admin')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                {{ $penjualans->links() }}
            </div>
        </div>
    </div>
</body>
@endsection

</html>