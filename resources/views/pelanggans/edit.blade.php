<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f9fc 0%, #e9ecef 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .main-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .page-title {
            color: #2d3436;
            font-size: 2rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, #4a90e2, #50c6db);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #2d3436;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.8rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.15);
        }

        .alert-danger {
            background-color: #fff5f5;
            border: none;
            border-left: 4px solid #fc8181;
            border-radius: 8px;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(to right, #4a90e2, #50c6db);
            border: none;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 144, 226, 0.3);
        }

        .btn-secondary {
            background: #95a5a6;
            border: none;
            margin-left: 1rem;
        }

        .form-icon {
            position: relative;
        }

        .form-icon i {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: #4a90e2;
        }

        .form-icon .form-control {
            padding-left: 2.5rem;
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 0 1rem;
            }

            .card {
                padding: 1.5rem;
            }

            .btn {
                width: 100%;
                margin: 0.5rem 0;
            }

            .btn-secondary {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="card">
            <h2 class="page-title">Edit Pelanggan</h2>

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pelanggans.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label" for="namapelanggan">
                        <i class="bi bi-person"></i> Nama Pelanggan
                    </label>
                    <input type="text" 
                           name="namapelanggan" 
                           id="namapelanggan" 
                           class="form-control" 
                           value="{{ old('namapelanggan', $pelanggan->namapelanggan) }}" 
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="Peran">
                        <i class="bi bi-person-badge"></i> Peran
                    </label>
                    <select name="Peran" id="Peran" class="form-control" required>
                        <option value="" disabled>Pilih Peran Anda</option>
                        <option value="member" {{ old('Peran', $pelanggan->Peran) == 'member' ? 'selected' : '' }}>
                            Member
                        </option>
                        <option value="pelanggan" {{ old('Peran', $pelanggan->Peran) == 'pelanggan' ? 'selected' : '' }}>
                            Pelanggan
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="Nomerunik">
                        <i class="bi bi-key"></i> Nomer Unik
                    </label>
                    <input type="text" 
                           name="Nomerunik" 
                           id="Nomerunik" 
                           class="form-control" 
                           value="{{ old('Nomerunik', $pelanggan->Nomerunik) }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="Alamat">
                        <i class="bi bi-geo-alt"></i> Alamat
                    </label>
                    <textarea name="Alamat" 
                              id="Alamat" 
                              class="form-control" 
                              rows="3" 
                              required>{{ old('Alamat', $pelanggan->Alamat) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="Nomer">
                        <i class="bi bi-telephone"></i> Nomor Telepon
                    </label>
                    <input type="text" 
                           name="Nomer" 
                           id="Nomer" 
                           class="form-control" 
                           value="{{ old('Nomer', $pelanggan->Nomer) }}" 
                           required>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>