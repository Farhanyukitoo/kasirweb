<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Load Bootstrap dan CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-profile text-center">
            <img src="https://png.pngtree.com/png-clipart/20230418/original/pngtree-cashier-line-icon-png-image_9064916.png" alt="User Avatar" class="img-fluid">
        </div>
        <p></p>
        <h4 class="text-white text-center"></h4>
        <a href="{{ url('/dashboards') }}"><i class="bi bi-house"></i> Dashboard</a>
        <a href="{{ url('/products') }}"><i class="bi bi-box"></i> Products</a>
        <a href="{{ url('/penjualans') }}"><i class="bi bi-cart"></i> Penjualan</a>
        
        @if(auth()->user() && auth()->user()->role === 'admin')
            <a href="{{ url('/pelanggans') }}"><i class="bi bi-people"></i> Pelanggan</a>
            <a href="{{ url('/laporan') }}"><i class="fas fa-chart-line"></i> Laporan</a>
        @endif
        
        @if(auth()->user() && auth()->user()->role === 'kasir')
            <a href="{{ url('/laporan') }}"><i class="fas fa-chart-line"></i> Laporan</a>
        @endif
        
        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <!-- Navbar -->
    <nav class="navbar p-2 bg-light shadow-sm d-flex justify-content-between">
        <span class="fw-bold">
            <i class="bi bi-cash-coin"></i> Aplikasi Kasir
        </span>
        <div>
            <i class="bi bi-person-circle"></i> 
            <span>{{ Auth::user()->name ?? 'User' }}</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content p-3">
        @yield('content')
    </div>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
