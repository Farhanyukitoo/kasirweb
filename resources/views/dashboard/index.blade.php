@extends('layouts.app') {{-- Pastikan layout benar --}}

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset ('css/dashboard.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>Dashboard</title>
</head>

<body>
    <!-- Header Dashboard -->

    <body style="overflow-y: scroll; height: 100vh;">
        <div class="dashboard-header">
            <i class="bi bi-shop"></i>
            <span>Dashboard</span>
            <span class="separator">|</span>
            <i class="bi bi-calendar-event"></i>
            <span id="current-date"></span>
            <span class="separator">|</span>
            <i class="bi bi-clock"></i>
            <span id="current-time"></span>
        </div>

        <!-- Stats Container -->
        <div class="stats-container">
            <!-- Product Card -->
            <div class="product-card">
                <p>Product</p>
                <p>{{ $totalProducts }}</p>
                <i class="bi bi-basket icon"></i>
            </div>

            <!-- Customer Card -->
            <div class="customer-card">
                <p>Pelanggan</p>
                <p>{{ $totalPelanggan }}</p>
                <i class="bi bi-person icon"></i>
            </div>

            <!-- Data Laporan Penjualan Card -->
            <div class="laporan-penjualan-card">
                <p>Data Laporan Penjualan</p>
                <p>{{ $totalLaporanPenjualan ?? 'Data Tidak Tersedia' }}</p>
                <i class="bi bi-bar-chart-line icon"></i>
            </div>


            <!-- Sales Card -->
            <div class="sales-card">
                <p>Penjualan</p>
                <p>{{ $totalPenjualan }}</p>
                <i class="bi bi-currency-dollar icon"></i>
            </div>


            <!-- Sales Details Card -->
            <div class="stok-card">
                <p>Stok</p>
                <p>{{ $totalStock }}</p>
                <i class="bi bi-box-seam icon"></i> <!-- Ikon stok dalam kotak -->
            </div>
        </div>


        <script>
            function updateDateTime() {
                const dateElement = document.getElementById("current-date");
                const timeElement = document.getElementById("current-time");

                // Format tanggal (Bahasa Indonesia)
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const today = new Date().toLocaleDateString('id-ID', options);
                dateElement.textContent = today;

                // Format jam (Real-time)
                const now = new Date();
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const seconds = now.getSeconds().toString().padStart(2, '0');
                timeElement.textContent = `${hours}:${minutes}:${seconds}`;
            }

            // Perbarui jam setiap detik
            setInterval(updateDateTime, 1000);

            // Panggil fungsi pertama kali
            updateDateTime();
        </script>
    </body>

</html>
@endsection