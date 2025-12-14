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
                    <h5 class="fw-bold text-dark"><i class="fa fa-sliders me-2"></i> Pengaturan Aplikasi</h5>
                    <hr class="mt-2 mb-0 opacity-10">
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.preferences') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label text-muted small fw-bold">BAHASA APLIKASI</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fa fa-globe text-muted"></i></span>
                                    <select name="language" class="form-select">
                                        <option value="id" {{ $user->language == 'id' ? 'selected' : '' }}>Bahasa Indonesia 🇮🇩</option>
                                        <option value="en" {{ $user->language == 'en' ? 'selected' : '' }}>English (US) 🇺🇸</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label text-muted small fw-bold">TEMA TAMPILAN</label>
                                <div class="d-flex align-items-center p-2 border rounded">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="theme" id="themeLight" value="light" {{ $user->theme == 'light' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="themeLight"><i class="fa fa-sun text-warning me-1"></i> Terang</label>
                                    </div>
                                    <div class="form-check form-check-inline ms-3">
                                        <input class="form-check-input" type="radio" name="theme" id="themeDark" value="dark" {{ $user->theme == 'dark' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="themeDark"><i class="fa fa-moon text-secondary me-1"></i> Gelap</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center p-3 rounded" style="background-color: rgba(0,0,0,0.03);">
                            <div>
                                <h6 class="fw-bold mb-0 text-body">Notifikasi Email</h6>
                                <small class="text-muted">Terima email harian tentang tugas Anda.</small>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="email_notification" role="switch" id="notifSwitch" {{ $user->email_notification ? 'checked' : '' }} style="width: 3em; height: 1.5em; cursor: pointer;">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm">Simpan Pengaturan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection