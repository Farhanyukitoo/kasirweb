<!-- resources/views/pelanggans/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Detail Pelanggan</h2>

        <!-- Display the Pelanggan details -->
        <div class="card">
            <div class="card-header">
                <h3>{{ $pelanggan->namapelanggan }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Peran:</strong> {{ $pelanggan->Peran }}</p>
                <p><strong>Nomer Unik:</strong> {{ $pelanggan->Nomerunik }}</p>
                <p><strong>Alamat:</strong> {{ $pelanggan->Alamat }}</p>
                <p><strong>Nomor:</strong> {{ $pelanggan->Nomer }}</p>
                <p><strong>Dibuat pada:</strong> {{ $pelanggan->created_at }}</p>
                <p><strong>Terakhir diperbarui:</strong> {{ $pelanggan->updated_at }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">Kembali ke Daftar Pelanggan</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
