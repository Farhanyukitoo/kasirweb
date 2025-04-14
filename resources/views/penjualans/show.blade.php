<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <link rel="stylesheet" href="{{ asset('css/showpenjualan.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .receipt-container, .receipt-container * {
                visibility: visible;
            }
            .receipt-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .print-button, .back-button {
                display: none;
            }
        }
    </style>
    <script>
        function exportTo(type) {
            if (type === 'pdf') {
                window.print();
            } else if (type === 'jpg') {
                html2canvas(document.querySelector(".receipt-container"), {
                    scale: 2, // Meningkatkan resolusi
                    backgroundColor: '#ffffff' // Menambahkan latar belakang putih agar lebih jelas
                }).then(canvas => {
                    let a = document.createElement('a');
                    a.href = canvas.toDataURL("image/jpeg", 1.0); // Kualitas maksimum
                    a.download = 'struk_penjualan.jpg';
                    a.click();
                });
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h2><i class="bi bi-cart-check icon"></i> Struk Penjualan</h2>
            <p><i class="bi bi-clock icon"></i> Tanggal: {{ $penjualan->Tanggalpenjualan }}</p>
        </div>

        <div class="receipt-details">
            <table>
                <tr>
                    <th><i class="bi bi-person icon"></i> Pelanggan</th>
                    <td>{{ $penjualan->pelanggan->namapelanggan }} - {{ $penjualan->pelanggan->Peran }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-box-seam icon"></i> Nama Produk</th>
                    <td>{{ $penjualan->product->name }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-cash-coin icon"></i> Harga</th>
                    <td>Rp {{ number_format($penjualan->product->price, 3, ',', '.') }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-tag icon"></i> Total Harga</th>
                    <td>Rp {{ number_format($penjualan->totalharga, 3, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="total-price">
            <p>Total Pembayaran: <span>Rp {{ number_format($penjualan->totalharga, 3, ',', '.') }}</span></p>
        </div>

        <div class="receipt-footer">
            <p>&copy; 2025 Toko Farhan</p>
        </div>

        <a href="#" class="print-button" onclick="exportTo('pdf'); return false;">
            <i class="bi bi-printer icon"></i> Cetak PDF
        </a>

        <a href="#" class="print-button" onclick="exportTo('jpg'); return false;">
            <i class="bi bi-file-image icon"></i> Simpan sebagai JPG
        </a>

        <a href="{{ route('penjualans.index') }}" class="back-button">
            <i class="bi bi-arrow-left icon"></i> Kembali ke Daftar Penjualan
        </a>
    </div>
</body>

</html>
