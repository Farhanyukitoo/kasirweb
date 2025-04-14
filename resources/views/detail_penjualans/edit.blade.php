    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="shortcut icon" href="https://cdn-icons-png.freepik.com/256/2753/2753001.png?semt=ais_hybrid" type="image/x-icon">

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
    cursor: pointer;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #545b62;
}

.btn-primary {
    background-color: #3498db;
    color: white;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.alert-danger ul {
    margin: 0;
    padding-left: 20px;
}

form {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
}

.form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #495057;
}

.form-control, .form-select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    transition: border-color 0.3s ease;
}

.form-control:focus, .form-select:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

@media screen and (max-width: 600px) {
    form {
        padding: 15px;
        width: 90%;
    }
}
</style>
    <body>
    <h1>Edit Detail Penjualan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('detail-penjualans.update', $detailPenjualan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="penjualan_id" class="form-label">Penjualan</label>
            <select name="penjualan_id" id="penjualan_id" class="form-select">
                @foreach ($penjualans as $penjualan)
                    <option value="{{ $penjualan->id }}" {{ $detailPenjualan->penjualan_id == $penjualan->id ? 'selected' : '' }}>
                        {{ $penjualan->Tanggalpenjualan }} - Total: Rp{{ number_format($penjualan->totalharga, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="produk_id" class="form-label">Produk</label>
            <select name="produk_id" id="produk_id" class="form-select">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $detailPenjualan->produk_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} - Stok: {{ $product->stock }} - Harga: Rp{{ number_format($product->price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlahproduk" class="form-label">Jumlah Produk</label>
            <input type="number" name="jumlahproduk" id="jumlahproduk" class="form-control" value="{{ $detailPenjualan->jumlahproduk }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="number" name="subtotal" id="subtotal" class="form-control" value="{{ $detailPenjualan->subtotal }}" step="0.01" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('detail-penjualans.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    </form>
   
    </body>
    </html>
 