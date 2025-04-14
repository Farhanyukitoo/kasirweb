<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/indexpelanggan.css') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Daftar Pelanggan</title>
</head>

<body>
@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container py-4">
    <!-- Page Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="header-container">
                <h2 class="page-title">Daftar Pelanggan</h2>
                <div class="header-line"></div>
                <p class="header-subtitle">Kelola data pelanggan dengan mudah dan efisien</p>
            </div>
        </div>
    </div>


   <form method="GET" action="{{ route('pelanggans.index') }}">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <!-- Search Box with Icon -->
                    <div class="d-flex align-items-center">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control ms-2" name="search" placeholder="Cari pelanggan berdasarkan nama atau nomor..." value="{{ request('search') }}">
                    </div>
                </th>
                <th>
                   <!-- Peran Filter Dropdown with Icon -->
<div class="d-flex align-items-center">
    <i class="bi bi-filter me-2"></i> <!-- Add margin for better spacing between icon and dropdown -->
    <select class="form-select" name="peran">
        <option value="">Semua Peran</option>
        <option value="member" {{ request('peran') == 'member' ? 'selected' : '' }}>Member</option>
        <option value="pelanggan" {{ request('peran') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
    </select>
</div>

                </th>
                <th>
                    <!-- Submit Button for Search -->
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </th>
                <th>
                    <!-- Add Customer Button -->
                    <div class="text-end">
                        <a href="{{ route('pelanggans.create') }}" class="btn btn-success">
                            <i class="bi bi-person-plus"></i> Tambah Pelanggan
                        </a>
                    </div>
                </th>
            </tr>
        </thead>
    </table>
</form>


    @if($pelanggans->isEmpty())
    <p>Data pelanggan tidak ditemukan.</p>
@endif

    <!-- Data Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="data-card">
                <div class="table-container">
                    <table class="table customer-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama Pelanggan</th>
                                <th width="10%">Peran</th>
                                <th width="15%">Nomor Unik</th>
                                <th width="20%">Alamat</th>
                                <th width="15%">Nomor Telepon</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pelanggans->isEmpty())
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <h4>Belum Ada Data</h4>
                                        <p>Belum ada data pelanggan. Silakan tambahkan pelanggan baru.</p>
                                    </div>
                                </td>
                            </tr>
                            @else
                                @foreach ($pelanggans as $index => $pelanggan)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">
                                        <div class="customer-name-cell">
                                            <div class="avatar">{{ substr($pelanggan->namapelanggan, 0, 1) }}</div>
                                            <div class="name">{{ $pelanggan->namapelanggan }}</div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($pelanggan->Peran == 'member')
                                        <span class="role-badge member">Member</span>
                                        @elseif($pelanggan->Peran == 'pelanggan')
                                        <span class="role-badge customer">Pelanggan</span>
                                        @else
                                        <span class="role-badge unknown">Tidak Diketahui</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <span class="unique-id">{{ wordwrap($pelanggan->Nomerunik, 4, '  ', true) }}</span>
                                    </td>
                                    <td class="align-middle address-cell">{{ $pelanggan->Alamat }}</td>
                                    <td class="align-middle">
                                        <div class="phone-cell">
                                            <i class="bi bi-telephone"></i>
                                            <span>{{ $pelanggan->Nomer }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="action-buttons">
                                            <a href="{{ route('pelanggans.show', $pelanggan->id) }}" class="btn-action view" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('pelanggans.edit', $pelanggan->id) }}" class="btn-action edit" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('pelanggans.destroy', $pelanggan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action delete" title="Hapus" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="pagination-container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="pagination-info">
                                Menampilkan {{ $pelanggans->firstItem() ?? 0 }} hingga {{ $pelanggans->lastItem() ?? 0 }} dari {{ $pelanggans->total() }} data
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pagination-controls">
                                {{ $pelanggans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>