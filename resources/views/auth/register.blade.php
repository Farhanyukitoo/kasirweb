<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <p><i class="fas fa-exclamation-triangle" style="color: red;"></i> PERINGATAN!! Silakan buat akun terlebih dahulu jika belum memiliki akun.</p>
    
    <div class="container"> 
        <div class="register-form-container">
            <div class="register-form">
                <div class="form-header">
                    <h1>Create Account</h1>
                    <hr style="margin-top: 10px; margin-bottom: 10px;">
                    <p>Silakan isi formulir di bawah untuk melanjutkan</p>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label" for="name"><i class="fas fa-user"></i> Full Name</label>
                        <input id="name" type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" 
                               required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email"><i class="fas fa-envelope"></i> Email Address</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" 
                               required autocomplete="email">
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
                               name="password" required autocomplete="new-password">
                        <i class="password-toggle fas fa-eye" onclick="togglePassword('password')"></i>
                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password-confirm"><i class="fas fa-lock"></i> Confirm Password</label>
                        <input id="password-confirm" type="password" 
                               class="form-control" 
                               name="password_confirmation" required autocomplete="new-password">
                        <i class="password-toggle fas fa-eye" onclick="togglePassword('password-confirm')"></i>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>

                    <div class="login-link">
                        <i class="fas fa-sign-in-alt"></i> Already have an account? 
                        <a href="{{ route('login') }}" style="color: #6C3CE9; text-decoration: none;">
                            Login here
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="image-container">
            <img src="https://cdn.pixabay.com/photo/2021/10/25/00/22/cashier-6739535_1280.png" alt="Register Illustration">
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = passwordInput.nextElementSibling;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>