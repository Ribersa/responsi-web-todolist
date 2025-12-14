@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5">
            
            
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    
                    
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-clipboard-user fa-3x text-primary"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Welcome Back!</h3>
                        <p class="text-muted small">Silakan login untuk mengelola tugas Anda.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        
                        <div class="mb-4">
                            <label for="email" class="form-label text-muted small fw-bold ms-1">EMAIL ADDRESS</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="nama@email.com" style="border-radius: 0 12px 12px 0;">
                            </div>
                            @error('email')
                                <span class="text-danger small mt-1 d-block ms-1">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="mb-4">
                            <label for="password" class="form-label text-muted small fw-bold ms-1">PASSWORD</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input id="password" type="password" class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password" placeholder="Masukkan password">
                                
                                
                                <span class="input-group-text bg-white border-start-0 text-muted pe-3" onclick="togglePassword()" style="cursor: pointer; border-radius: 0 12px 12px 0; border: 1px solid #e0e0e0;">
                                    <i class="fa fa-eye" id="toggleIcon"></i>
                                </span>
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1 d-block ms-1">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small fw-bold" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow fw-bold">
                                {{ __('MASUK SEKARANG') }}
                            </button>
                        </div>

                        
                        <div class="text-center">
                            <p class="text-muted small mb-0">Belum punya akun? 
                                <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Daftar disini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="text-center mt-4 text-muted small opacity-75">
                &copy; {{ date('Y') }} ToDoApp Project
            </div>

        </div>
    </div>
</div>


<script>
    function togglePassword() {
        var passwordInput = document.getElementById('password');
        var icon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection