<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #545b62;
}

.card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
    overflow: hidden;
}

.card-header {
    background-color: #3498db;
    color: white;
    padding: 15px;
    font-weight: bold;
}

.card-body {
    padding: 20px;
}

.card-title {
    margin-bottom: 15px;
    color: #2c3e50;
}

.card-text {
    margin-bottom: 10px;
    line-height: 1.6;
}

.card-text strong {
    color: #495057;
    display: inline-block;
    width: 150px;
}

@media screen and (max-width: 600px) {
    .card {
        width: 95%;
        margin: 0 auto;
    }
}
</style>
<body>
<h1>Detail Penjualan</h1>

    <div class="card">
        <div class="card-header">
            Informasi Detail Penjualan
        </div>
        <div class="card-body">
            <!-- <h5 class="card-title">ID Detail Penjualan: {{ $detailPenjualan->id }}</h5> -->
            
            <p class="card-text">
                <strong>Penjualan:</strong> 
                {{ $detailPenjualan->penjualan->Tanggalpenjualan }} <br>
                <strong>Total Harga:</strong> Rp{{ number_format($detailPenjualan->penjualan->totalharga, 2) }}
            </p>

            <p class="card-text">
                <strong>Produk:</strong> {{ $detailPenjualan->product->name }} <br>
                <strong>Harga Produk:</strong> Rp{{ number_format($detailPenjualan->product->price, 2) }}
            </p>

            <p class="card-text">
                <strong>Jumlah Produk:</strong> {{ $detailPenjualan->jumlahproduk }}
            </p>

            <p class="card-text">
                <strong>Subtotal:</strong> Rp{{ number_format($detailPenjualan->subtotal, 2) }}
            </p>
            <a href="{{ route('detail-penjualans.index') }}" class="btn btn-secondary mb-3">Kembali</a>

        </div>
    </div>

</body>
</html>
   