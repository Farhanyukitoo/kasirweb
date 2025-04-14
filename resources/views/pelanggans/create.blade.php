<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan Create</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/createpelanggan.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/6136/6136178.png" type="image/x-icon">
</head>

<body>
@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')

<div class="container mt-4">
    <div class="card p-4">
        <h2 class="mb-4 text-center">Tambah Pelanggan Baru</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pelanggans.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="namapelanggan"><i class="bi bi-person"></i> Nama Pelanggan</label>
                <input type="text" name="namapelanggan" id="namapelanggan" class="form-control" required placeholder="Tambahkan Nama Pelanggan">
            </div>

            <div class="form-group mb-3">
                <label for="Peran"><i class="bi bi-person-badge"></i> Peran</label>
                <select name="Peran" id="Peran" class="form-control" required>
                    <option value="" disabled selected>Pilih Peran Anda</option>
                    <option value="member">Member</option>
                    <option value="pelanggan">Pelanggan</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="Nomerunik"><i class="bi bi-key"></i> Nomer Unik</label>
                <input type="text" name="Nomerunik" id="Nomerunik" class="form-control" required placeholder="Tambahkan Nomer Unik" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="Alamat"><i class="bi bi-geo-alt"></i> Alamat</label>
                <textarea name="Alamat" id="Alamat" class="form-control" required placeholder="Tambahkan Alamat"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="Nomer"><i class="bi bi-telephone"></i> Nomer Telepon</label>
                <input type="number" name="Nomer" id="Nomer" class="form-control" required placeholder="Tambahkan Nomer">
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
            <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </form>
    </div>
</div>
@endsection


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        function generateUniqueNumber() {
            let length = 16; // Fixed length of 16 digits
            let numbers = "";
            for (let i = 0; i < length; i++) {
                numbers += Math.floor(Math.random() * 10); // Generate random digit (0-9)
            }
            return numbers;
        }

        function setUniqueNumber() {
            let nomerUnikField = document.getElementById("Nomerunik");
            if (nomerUnikField) {
                nomerUnikField.value = generateUniqueNumber();
            }
        }

        let namaPelangganField = document.getElementById("namapelanggan");
        let peranField = document.getElementById("Peran");

        if (namaPelangganField) {
            namaPelangganField.addEventListener("input", setUniqueNumber);
        }

        if (peranField) {
            peranField.addEventListener("change", setUniqueNumber);
        }

        // Make the Nomer Unik field read-only
        document.getElementById("Nomerunik").readOnly = true;
    });
</script>


  
</body>
</html>
