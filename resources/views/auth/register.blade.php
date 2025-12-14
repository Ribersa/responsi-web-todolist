@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-user-plus fa-3x text-primary"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Buat Akun Baru</h3>
                        <p class="text-muted small">Bergabunglah dan mulai atur produktivitasmu.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label text-muted small fw-bold ms-1">NAMA LENGKAP</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input id="name" type="text" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                       placeholder="Nama Lengkap Anda" style="border-radius: 0 12px 12px 0;">
                            </div>
                            @error('name')
                                <span class="text-danger small mt-1 d-block ms-1">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-muted small fw-bold ms-1">EMAIL ADDRESS</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                       placeholder="nama@email.com" style="border-radius: 0 12px 12px 0;">
                            </div>
                            @error('email')
                                <span class="text-danger small mt-1 d-block ms-1">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label text-muted small fw-bold ms-1">PASSWORD</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password" placeholder="Min 8 karakter">

                                    <span class="input-group-text bg-white border-start-0 text-muted pe-3" onclick="toggleRegisterPassword()" style="cursor: pointer; border-radius: 0 12px 12px 0; border: 1px solid #e0e0e0;">
                                        <i class="fa fa-eye" id="toggleIconRegister"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <span class="text-danger small mt-1 d-block ms-1">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password-confirm" class="form-label text-muted small fw-bold ms-1">ULANGI PASSWORD</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input id="password-confirm" type="password" class="form-control border-start-0 ps-0" 
                                           name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" style="border-radius: 0 12px 12px 0;">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow fw-bold">
                                {{ __('DAFTAR SEKARANG') }}
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-muted small mb-0">Sudah punya akun? 
                                <a href="{{ route('login') }}" class="fw-bold text-primary text-decoration-none">Login disini</a>
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
    function toggleRegisterPassword() {
        var pass1 = document.getElementById('password');
        var pass2 = document.getElementById('password-confirm');
        var icon = document.getElementById('toggleIconRegister');
        
        if (pass1.type === "password") {
            pass1.type = "text";
            pass2.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            pass1.type = "password";
            pass2.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection