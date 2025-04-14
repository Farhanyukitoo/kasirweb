<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Kasir</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
   <!-- Navbar -->
<nav class="navbar">
    <div class="navbar-brand">
        <img src="https://png.pngtree.com/png-vector/20220607/ourmid/pngtree-woman-cashier-icon-outline-vector-png-image_4855814.png" alt="Kasir Digital" class="navbar-logo">
    </div>
    <div class="navbar-links">
    <a href="{{ route('login') }}" class="navbar-link">
        <i class="bi bi-box-arrow-in-right"></i> Login
    </a>
    <a href="{{ route('register') }}" class="navbar-link">
        <i class="bi bi-person-plus"></i> Register
    </a>   
</div>
</nav>


   <!-- Hero Section -->
<header class="hero-section">
    <h1>Aplikasi Kasir</h1>
    <p>Mengelola transaksi dengan mudah dan cepat</p>
    <!-- Perbaiki button untuk meningkatkan keterlihatan dan memastikan scrolling yang smooth -->
    <!-- <a href="#features" class="btn btn-primary btn-lg">Jelajahi Fitur</a> -->
</header>


    <!-- Features Section -->
    <section id="features" class="features container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="bi bi-receipt-cutoff feature-icon"></i>
                    <h4>Transaksi Cepat</h4>
                    <p>Proses pembayaran dengan efisien.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="bi bi-shield-check feature-icon"></i>
                    <h4>Keamanan Data</h4>
                    <p>Data pelanggan dan transaksi aman.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="bi bi-bar-chart-line feature-icon"></i>
                    <h4>Laporan Detail</h4>
                    <p>Analisis penjualan secara lengkap.</p>
                </div>
            </div>
        </div>
    </section>

   <!-- Footer Section -->
<footer class="footer bg-dark text-white text-center py-4">
    <div class="container">
        <p>&copy; 2025 Kasir Digital. All Rights Reserved.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="https://facebook.com" class="text-white" style="text-decoration: none;">
                <i class="bi bi-facebook"></i> Facebook
            </a>
            <a href="https://twitter.com" class="text-white" style="text-decoration: none;">
                <i class="bi bi-twitter"></i> Twitter
            </a>
            <a href="https://instagram.com" class="text-white" style="text-decoration: none;">
                <i class="bi bi-instagram"></i> Instagram
            </a>
        </div>
    </div>
</footer>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
