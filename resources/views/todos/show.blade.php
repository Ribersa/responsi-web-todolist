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

            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                
                
                <div class="card-header border-0 pt-4 pb-0 px-5 bg-white">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 text-primary">
                            <i class="fa-solid fa-file-lines fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Detail Tugas</h5>
                            <p class="text-muted small mb-0">Informasi lengkap mengenai tugas ini.</p>
                        </div>
                    </div>
                    <hr class="mt-4 mb-0 opacity-10">
                </div>

                <div class="card-body p-5">
                    
                    
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <h2 class="fw-bold text-dark mb-0" style="line-height: 1.2;">
                            {{ $todo->title }}
                        </h2>
                    </div>

                    
                    <div class="mb-4">
                        @if($todo->is_completed)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 border border-success border-opacity-25 fs-6">
                                <i class="fa-solid fa-circle-check me-2"></i> Selesai Dikerjakan
                            </span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 border border-warning border-opacity-25 fs-6">
                                <i class="fa-solid fa-hourglass-half me-2"></i> Dalam Proses
                            </span>
                        @endif
                    </div>

                    
                    <div class="mb-4">
                        <label class="text-muted small fw-bold text-uppercase mb-2">Deskripsi Tugas</label>
                        <div class="p-4 rounded-3 bg-light border border-light">
                            @if($todo->description)
                                <p class="mb-0 text-dark" style="line-height: 1.6; white-space: pre-line;">{{ $todo->description }}</p>
                            @else
                                <p class="mb-0 text-muted fst-italic">
                                    <i class="fa-regular fa-clipboard me-1"></i> Tidak ada deskripsi tambahan untuk tugas ini.
                                </p>
                            @endif
                        </div>
                    </div>

                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded-3 h-100">
                                <i class="fa-regular fa-calendar-plus fa-2x text-primary me-3 opacity-50"></i>
                                <div>
                                    <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Dibuat Pada</small>
                                    <span class="fw-bold text-dark">{{ $todo->created_at->format('d M Y') }}</span>
                                    <small class="d-block text-muted">Pukul {{ $todo->created_at->format('H:i') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 border rounded-3 h-100">
                                <i class="fa-solid fa-clock-rotate-left fa-2x text-info me-3 opacity-50"></i>
                                <div>
                                    <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.7rem;">Terakhir Diupdate</small>
                                    <span class="fw-bold text-dark">{{ $todo->updated_at->diffForHumans() }}</span>
                                    <small class="d-block text-muted">{{ $todo->updated_at->format('d M Y, H:i') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                
                <div class="card-footer bg-light border-0 p-4">
                    <div class="d-flex justify-content-end gap-2">
                        
                        
                        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning text-white fw-bold rounded-pill px-4 shadow-sm">
                            <i class="fa-solid fa-pen-to-square me-2"></i> Edit
                        </a>

                        
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger fw-bold rounded-pill px-4 shadow-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini secara permanen?')">
                                <i class="fa-solid fa-trash me-2"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection