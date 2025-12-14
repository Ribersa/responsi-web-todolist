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
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 text-primary">
                            <i class="fa-solid fa-pen-to-square fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">Edit Tugas</h4>
                            <p class="text-muted small mb-0">Perbarui informasi tugas Anda di bawah ini.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('todos.update', $todo->id) }}">
                        @csrf
                        @method('PUT')

                        
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
                                       value="{{ old('title', $todo->title) }}" 
                                       required
                                       placeholder="Apa yang perlu diselesaikan?"
                                       style="border-radius: 0 12px 12px 0; border: 1px solid #e0e0e0;">
                            </div>
                            @error('title')
                                <span class="text-danger small mt-1 d-block ms-1">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="mb-4">
                            <label for="description" class="form-label text-muted small fw-bold ms-1">DESKRIPSI DETAIL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3 align-items-start pt-3" style="border-radius: 12px 0 0 12px; border: 1px solid #e0e0e0;">
                                    <i class="fa-solid fa-align-left"></i>
                                </span>
                                <textarea class="form-control border-start-0 ps-2" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          placeholder="Tambahkan catatan tambahan (opsional)..."
                                          style="border-radius: 0 12px 12px 0; border: 1px solid #e0e0e0;">{{ old('description', $todo->description) }}</textarea>
                            </div>
                        </div>

                        
                        <div class="mb-4 p-3 bg-light rounded-3 border d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Status Tugas</h6>
                                <small class="text-muted">Aktifkan jika tugas ini sudah selesai.</small>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_completed" name="is_completed" value="1" {{ $todo->is_completed ? 'checked' : '' }} style="width: 3em; height: 1.5em; cursor: pointer;">
                            </div>
                        </div>

                        
                        <div class="alert alert-info border-0 d-flex align-items-center mb-4 small" role="alert">
                            <i class="fa-solid fa-circle-info me-2"></i>
                            <div>
                                Tugas ini dibuat pada <strong>{{ $todo->created_at->format('d M Y, H:i') }}</strong>
                            </div>
                        </div>

                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('todos.index') }}" class="btn btn-light text-secondary rounded-pill px-4 fw-bold shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow">
                                <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection