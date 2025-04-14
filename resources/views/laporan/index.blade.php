<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>

    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @extends('layouts.app')

    @section('title', 'Laporan Penjualan')

    @section('content')
    <div class="container mt-4">
        <div class="report-header d-flex justify-content-between align-items-center">
            <div>
                <h2><i class="bi bi-clipboard-data"></i> Laporan Penjualan</h2>
                <p><strong>Periode:</strong> {{ $start_date ? date('d M Y', strtotime($start_date)) : '-' }}
                    s/d {{ $end_date ? date('d M Y', strtotime($end_date)) : '-' }}</p>
            </div>
            <div class="report-date">
                <strong>Tanggal Laporan:</strong> {{ date('d F Y') }}
            </div>
        </div>

        <!-- Form Filter -->
        <form method="GET" action="{{ route('laporan.index') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Dari Tanggal:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Sampai Tanggal:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary w-100">
                <i class="bi bi-arrow-counterclockwise"></i> Reset
            </a>
            <button class="btn btn-primary w-100 btn-cetak" onclick="window.print()">
                <i class="bi bi-printer"></i> Cetak Laporan
            </button>
        </form>

        <!-- Tabel Penjualan -->
        <h2><i class="bi bi-box-seam"></i> Tanggal Produk</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Harga Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualans as $penjualan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d-m-Y', strtotime($penjualan->Tanggalpenjualan)) }}</td>
                        <td>{{ $penjualan->pelanggan->namapelanggan ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $penjualan->product->name ?? 'Tidak Diketahui' }}</td>
                        <td>Rp{{ number_format($penjualan->product->price ?? 0, 2, ',', '.') }}</td>
                        <td>{{ $penjualan->jumlah ?? 1 }}</td>
                        <td>Rp{{ number_format($penjualan->totalharga, 2, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data penjualan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Daftar Produk -->
        <h2><i class="bi bi-box-seam"></i> Daftar Produk</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td class="text-end">Rp{{ number_format($product->price, 2, ',', '.') }}</td>
                        <td class="text-center">{{ $product->stock }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data produk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Daftar Penjualan -->
        <h2><i class="bi bi-cart-check"></i> Daftar Penjualan</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Harga Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualans as $penjualan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ date('d M Y', strtotime($penjualan->Tanggalpenjualan)) }}</td>
                        <td>{{ $penjualan->pelanggan->namapelanggan ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $penjualan->product->name ?? 'Tidak Diketahui' }}</td>
                        <td class="text-end">Rp{{ number_format($penjualan->product->price ?? 0, 2, ',', '.') }}</td>
                        <td class="text-center">{{ $penjualan->jumlah ?? 1 }}</td>
                        <td class="text-end">Rp{{ number_format($penjualan->totalharga, 2, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data penjualan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Ringkasan Penjualan -->
        <div class="summary-box">
            <h3><i class="bi bi-clipboard-data"></i> Ringkasan Penjualan</h3>
            <div class="summary-item">
                <span>Total Penjualan:</span>
                <span>{{ count($penjualans) }}</span>
            </div>
            <div class="summary-item">
                <span>Total Produk:</span>
                <span>{{ count($products) }}</span>
            </div>
            <div class="summary-item summary-total">
                <span>Total Pendapatan:</span>
                <span>Rp{{ number_format($penjualans->sum('totalharga'), 2, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <script>
        function showNotification(message, type) {
            let notification = document.createElement('div');
            notification.className = 'alert alert-' + type + ' fixed-top m-3 notification';
            notification.style.position = 'fixed';
            notification.style.top = '20px';
            notification.style.left = '50%';
            notification.style.transform = 'translateX(-50%)';
            notification.style.transition = 'opacity 0.5s ease-in-out';
            notification.style.opacity = '1';
            notification.innerHTML = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 3000);
        }

        document.querySelector('.btn-cetak').addEventListener('click', function() {
            setTimeout(() => {
                if (window.matchMedia('print').matches) {
                    showNotification('Cetak PDF berhasil!', 'success');
                } else {
                    showNotification('Cetak PDF dibatalkan.', 'warning');
                }
            }, 1000);
        });
    </script>

    @endsection
</body>

</html>