<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="{{ asset('css/showpenjualan.css') }}">

    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #2d3748;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Header Styles */
        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2rem;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -10px;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: #4299e1;
            border-radius: 4px;
        }

        /* Product Detail Styles */
        .product-detail {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .product-image {
            width: 300px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        .product-info {
            text-align: left;
            width: 100%;
            margin-top: 20px;
        }

        .product-info div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .product-info label {
            font-weight: 500;
            color: #4a5568;
            min-width: 100px;
        }

        .product-info span {
            font-size: 1rem;
            color: #2d3748;
            font-weight: 500;
        }

        /* Button Styles */
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .btn-success {
            background-color: #3182ce;
            color: white;
        }

        .btn-success:hover {
            background-color: #2b6cb0;
            box-shadow: 0 4px 6px rgba(49, 130, 206, 0.2);
        }

        .btn-danger {
            background-color: #e53e3e;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c53030;
            box-shadow: 0 4px 6px rgba(229, 62, 62, 0.2);
        }

        .btn-secondary {
            background-color: #718096;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4a5568;
            box-shadow: 0 4px 6px rgba(113, 128, 150, 0.2);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Detail Produk</h2>
        <div class="product-detail">
            <!-- Gambar Produk -->
            <a href="{{ asset('images/' . $product->image) }}" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
            </a>
            <!-- Informasi Produk -->
            <div class="product-info">
                <div>
                    <label>Nama Produk:</label>
                    <span>{{ $product->name }}</span>
                </div>
                <div>
                    <label>Harga:</label>
                    <span>Rp {{ number_format($product->price, 3, ',', '.') }}</span>
                </div>
                <div>
                    <label>Stok:</label>
                    <span>{{ $product->stock }}</span>
                </div>
            </div>
            <!-- Tombol Aksi -->
            @if(auth()->user() && auth()->user()->role === 'admin')
            <div style="margin-top: 20px;">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                    @endif
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                </form>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>