<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- <style>
        /* Loader Styles */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:rgb(255, 255, 255);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader-content {
            text-align: center;
        }

        .loader-logo {
            font-size: 48px;
            color: #00bfff;
            margin-bottom: 10px;
        }

        .loader-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #ccc;
            border-top: 6px solid #00bfff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        .loader-text {
            font-size: 14px;
            color: #ccc;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .container {
            display: none;
        }
    </style> -->
</head>

<body>

    <!-- Loader
    <div class="loader-container" id="loaderContainer">
        <div class="loader-content">
            <div class="loader-logo">
                <i class="fas fa-cash-register"></i>
            </div>
            <div class="loader-title">Aplikasi Kasir</div>
            <div class="spinner"></div>
            <p class="loader-text">Memuat halaman login...</p>
        </div>
    </div> -->

    <!-- Peringatan -->
    <p><i class="fas fa-exclamation-triangle" style="color: red;"></i> PERINGATAN!! Jika belum memiliki Akun maka diharapkan Buat Akun terlebih dahulu.</p>

    <div class="container">
        <div class="login-form-container">
            <div class="login-form">
                <div class="form-header">
                    <a href="{{ url('/') }}" class="back-button">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <h1>Hello!</h1>
                    <hr style="margin-top: 10px; margin-bottom: 10px;">
                    <p>Selamat datang di Aplikasi Kasir</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email"><i class="fas fa-user"></i> Username</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}"
                            required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password"><i class="fas fa-lock"></i> Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        <i class="password-toggle fas fa-eye" onclick="togglePassword()"></i>
                        @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                            name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        <i class="fas fa-key"></i> Forgot password?
                    </a>
                    @endif

                    <div class="create-account">
                        <i class="fas fa-user-plus"></i> Don't have an account?
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" style="color: #6C3CE9; text-decoration: none;">
                            Create Account
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="image-container">
            <img src="https://cdn.pixabay.com/photo/2021/10/25/00/22/cashier-6739535_1280.png"
                alt="Cashier Application">
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }

        // Loader timeout
        window.addEventListener('load', function () {
            setTimeout(() => {
                document.getElementById('loaderContainer').style.display = 'none';
                document.querySelector('.container').style.display = 'flex';
            }, 1500); // 1.5 detik
        });
    </script>

</body>

</html>
