@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            
            <div class="mb-4">
                <a href="{{ route('todos.index') }}" class="text-decoration-none text-muted fw-bold small">
                    <i class="fa-solid fa-arrow-left me-1"></i> KEMBALI KE DAFTAR
                </a>
            </div>

            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                
                
                <div class="card-header bg-white border-0 pt-4 pb-0 px-5">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3 text-success">
                            <i class="fa-solid fa-plus fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">Buat Tugas Baru</h4>
                            <p class="text-muted small mb-0">Rencanakan produktivitas Anda hari ini.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('todos.store') }}">
                        @csrf

                        
                        <div class="mb-4">
                            <label for="title" class="form-label text-muted small fw-bold ms-1">JUDUL TUGAS</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                    <i class="fa-solid fa-heading"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0 ps-2 @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}" 
                                       required
                                       autofocus
                                       placeholder="Contoh: Menyelesaikan Laporan Bulanan"
                                       style="border-radius: 0 12px 12px 0; border: 1px solid #e0e0e0;">
                            </div>
                            @error('title')
                                <span class="text-danger small mt-1 d-block ms-1">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="mb-4">
                            <label for="description" class="form-label text-muted small fw-bold ms-1">DESKRIPSI DETAIL <span class="fw-normal text-muted fst-italic">(Opsional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3 align-items-start pt-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                    <i class="fa-solid fa-align-left"></i>
                                </span>
                                <textarea class="form-control border-start-0 ps-2" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          placeholder="Tambahkan catatan, link, atau detail penting lainnya..."
                                          style="border-radius: 0 12px 12px 0; border: 1px solid #e0e0e0;">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        
                        <div class="alert alert-light border d-flex align-items-center mb-4 small text-muted rounded-3" role="alert">
                            <i class="fa-regular fa-lightbulb me-2 text-warning fs-5"></i>
                            <div>
                                <strong>Tips:</strong> Pecah tugas besar menjadi tugas-tugas kecil agar lebih mudah dikelola.
                            </div>
                        </div>

                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('todos.index') }}" class="btn btn-light text-secondary rounded-pill px-4 fw-bold shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow">
                                <i class="fa-solid fa-paper-plane me-2"></i> Simpan Tugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection