<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Penjualan</title>
    <link rel="shortcut icon" href="https://png.pngtree.com/png-vector/20220607/ourmid/pngtree-woman-cashier-icon-outline-vector-png-image_4855814.png" type="image/x-icon">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Seleksi elemen notifikasi
            const alert = document.querySelector('.alert-success');
            if (alert) {
                // Hilangkan elemen setelah 3 detik
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = 0;
                    setTimeout(() => alert.remove(), 500); // Hapus dari DOM setelah animasi
                }, 3000);
            }
        });
    </script>

@extends('layouts.app')

@section('title', 'idnex penjualan')

@section('content')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
            margin-bottom: 20px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #e9ecef;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #dcfce7;
            border: 1px solid #22c55e;
            color: #166534;
        }

        @media screen and (max-width: 600px) {
            .table, .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }

            .table thead {
                display: none;
            }

            .table tr {
                margin-bottom: 10px;
                border: 1px solid #ddd;
            }

            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
<h1>Detail Penjualan</h1>

<!-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif -->

<a href="{{ route('detail-penjualans.create') }}" class="btn btn-primary">Tambah Detail Penjualan</a>
<table class="table">
<thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
    <tbody>
        @foreach ($details as $detail)
            <tr>
            <td>{{ $loop->iteration }}</td>

                <!-- <td data-label="ID">{{ $detail->id }}</td> -->
                <td data-label="Penjualan">{{ $detail->penjualan->Tanggalpenjualan }}</td>
                <td data-label="Produk">{{ $detail->product->name }}</td>
                <td data-label="Jumlah">{{ $detail->jumlahproduk }}</td>
                <td data-label="Subtotal">{{ $detail->subtotal }}</td>
                <td data-label="Aksi">
                    <a href="{{ route('detail-penjualans.show', $detail->id) }}" class="btn btn-info">Lihat</a>
                    <a href="{{ route('detail-penjualans.edit', $detail->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('detail-penjualans.destroy', $detail->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Hapus detail ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @endsection
    </tbody>
</table>

</body>
</html>
