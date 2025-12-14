@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="{{ route('todos.index') }}" class="text-decoration-none text-muted fw-bold small">
                    <i class="fa-solid fa-arrow-left me-1"></i> KEMBALI KE DASHBOARD
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4 rounded-3">
                    <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold text-danger"><i class="fa fa-shield-halved me-2"></i> Keamanan Akun</h5>
                    <hr class="mt-2 mb-0 opacity-10">
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">PASSWORD SAAT INI</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">PASSWORD BARU</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required minlength="8">
                                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">ULANGI PASSWORD BARU</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection