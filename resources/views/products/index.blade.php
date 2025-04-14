    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Produk</title>
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/indexproduk.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Favicon -->
        <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/6136/6136178.png" type="image/x-icon">
    </head>

    <body>
        @extends('layouts.app')

        @section('title', 'Index Penjualan')

        @section('content')
        <div class="daftarproduk">
            <i class="bi bi-box-seam"></i> Daftar Produk
        </div>
        <div class="jarakz"></div>

        <!-- Form Pencarian -->
        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="price_range" class="form-label">
                        <i class="bi bi-cash-coin"></i> Filter Harga:
                    </label>
                    <select name="price_range" id="price_range" class="form-select">
                        <option value="">Semua Harga</option>
                        <option value="0-50000" {{ request('price_range') == '0-50000' ? 'selected' : '' }}>0 - 50 Ribu</option>
                        <option value="100001-500000" {{ request('price_range') == '100001-500000' ? 'selected' : '' }}>100 Ribu - 500 Ribu</option>
                        <option value="500001+" {{ request('price_range') == '500001+' ? 'selected' : '' }}>Lebih dari 500 Ribu</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="stock_range" class="form-label">
                        <i class="bi bi-boxes"></i> Filter Stok:
                    </label>
                    <select name="stock_range" id="stock_range" class="form-select">
                        <option value="">Semua Stok</option>
                        <option value="1-3" {{ request('stock_range') == '1-3' ? 'selected' : '' }}>1 - 3</option>
                        <option value="4-6" {{ request('stock_range') == '4-6' ? 'selected' : '' }}>4 - 6</option>
                        <option value="7-11" {{ request('stock_range') == '7-11' ? 'selected' : '' }}>7 - 11</option>
                    </select>
                </div>
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>

        <!-- Tombol Tambah Produk -->
        @if(auth()->user() && auth()->user()->role === 'admin')
        <div class="tambah mb-4">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </a>
        </div>
        @endif

        <!-- Tabel Produk -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><i class="bi bi-list-ol"></i> No</th>
                    <th><i class="bi bi-box-seam"></i> Nama Produk</th>
                    <th><i class="bi bi-tags"></i> Harga</th>
                    <th><i class="bi bi-box"></i> Stok</th>
                    <th><i class="bi bi-image"></i> Gambar</th>
                    <th><i class="bi bi-tools"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="100"
                            data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                    </td>

                    <td>
                        <div class="khusus">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            @if(auth()->user() && auth()->user()->role === 'admin')
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            @endif
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                @if(auth()->user() && auth()->user()->role === 'admin')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                                @endif
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endsection

        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/indexproduk.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const productImages = document.querySelectorAll('table img');

                // Buat modal untuk menampilkan gambar
                const modal = document.createElement('div');
                modal.className = 'image-modal';
                modal.innerHTML = `
            <div class="modal-container">
                <button class="close-modal">&times;</button>
                <img class="modal-content" id="modal-image">
                <div id="modal-description">
                    <h5 id="modal-product-name"></h5>
                    <p id="modal-product-price"></p>
                </div>
            </div>
        `;
                document.body.appendChild(modal);

                const modalImage = modal.querySelector('#modal-image');
                const modalProductName = modal.querySelector('#modal-product-name');
                const modalProductPrice = modal.querySelector('#modal-product-price');
                const closeModal = modal.querySelector('.close-modal');

                productImages.forEach(img => {
                    img.addEventListener('click', function() {
                        modal.style.display = 'flex';
                        modalImage.src = this.src;

                        // Ambil nama dan harga produk berdasarkan atribut data produk
                        const productName = this.dataset.name; // Mengambil nama produk
                        const productPrice = this.dataset.price; // Mengambil harga produk

                        // Setel nama dan harga produk di modal
                        modalProductName.textContent = productName;
                        modalProductPrice.textContent = `Rp ${parseInt(productPrice).toLocaleString('id-ID')}`; // Menampilkan harga dalam format IDR

                        // Menyesuaikan ukuran gambar agar tetap rapi
                        modalImage.onload = function() {
                            modalImage.style.width = "auto";
                            modalImage.style.height = "auto";
                            modalImage.style.maxWidth = "80%"; // Maksimal lebar 80% dari layar
                            modalImage.style.maxHeight = "80vh"; // Maksimal tinggi 80% dari viewport
                        };
                    });
                });

                closeModal.onclick = function() {
                    modal.style.display = 'none';
                };

                modal.onclick = function(event) {
                    if (event.target === modal) {
                        modal.style.display = 'none';
                    }
                };
            });


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
    </body>

    </html>