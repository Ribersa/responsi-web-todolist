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
                    <h5 class="fw-bold text-primary"><i class="fa fa-user-pen me-2"></i> Edit Profil</h5>
                    <hr class="mt-2 mb-0 opacity-10">
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <div class="position-relative d-inline-block">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" class="rounded-circle shadow-sm" id="preview-img" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f8f9fa;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff&size=120" class="rounded-circle shadow-sm" id="preview-img" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f8f9fa;">
                                    @endif
                                    <label for="avatar" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow" style="cursor: pointer; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa fa-camera fa-sm"></i>
                                    </label>
                                    <input type="file" name="avatar" id="avatar" class="d-none" accept="image/*" onchange="previewImage(this)">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">NAMA LENGKAP</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold">EMAIL</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Simpan Profil</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader(); reader.onload = function(e) { document.getElementById('preview-img').src = e.target.result; }; reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection