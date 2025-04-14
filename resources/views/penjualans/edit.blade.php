<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjualan</title>
      <link rel="stylesheet" href="{{asset ('css/editpenjualan.css')}}">
</head>
<body>
    
<div class="container">
    <h1>Edit Penjualan</h1>

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <form action="{{ route('penjualans.update', $penjualan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="Tanggalpenjualan">Tanggal Penjualan</label>
            <input type="date" name="Tanggalpenjualan" id="Tanggalpenjualan" class="form-control" 
                   value="{{ old('Tanggalpenjualan', $penjualan->Tanggalpenjualan) }}" required>
        </div>

        <div class="form-group">
            <label for="totalharga">Total Harga</label>
            <input type="number" name="totalharga" id="totalharga" class="form-control" 
                   value="{{ old('totalharga', $penjualan->totalharga) }}" required>
        </div>

        <div class="form-group">
            <label for="pelanggan_id">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" 
                            {{ old('pelanggan_id', $penjualan->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->namapelanggan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('penjualans.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
</body>
</html>
