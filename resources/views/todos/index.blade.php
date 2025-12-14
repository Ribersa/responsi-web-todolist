@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-0">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted small">Berikut ringkasan produktivitas Anda hari ini.</p>
                </div>
                <div class="text-end">
                    <span class="text-muted small d-block">{{ now()->format('l, d F Y') }}</span>
                </div>
            </div>

            
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-primary text-white h-100" style="border-radius: 15px;">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                <i class="fa-solid fa-list-check fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-white-50 text-uppercase small fw-bold">Total Tugas</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalTodos }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-white h-100" style="border-radius: 15px; border-left: 5px solid #ffc107 !important;">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 me-3">
                                <i class="fa-regular fa-clock fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-muted text-uppercase small fw-bold">Dalam Proses</h6>
                                <h2 class="mb-0 fw-bold text-dark">{{ $pendingTodos }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-white h-100" style="border-radius: 15px; border-left: 5px solid #198754 !important;">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                                <i class="fa-solid fa-check-double fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-muted text-uppercase small fw-bold">Selesai</h6>
                                <h2 class="mb-0 fw-bold text-dark">{{ $completedTodos }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check me-2 fs-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <form action="{{ route('todos.index') }}" method="GET">
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted border border-end-0 ps-3" style="border-radius: 50px 0 0 50px; border-color: #ced4da;">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" name="search" 
                                           class="form-control bg-white border border-start-0 ps-2" 
                                           placeholder="Cari tugas Anda..." 
                                           value="{{ request('search') }}"
                                           style="border-radius: 0 50px 50px 0; border-color: #ced4da;">
                                    <button class="btn btn-primary px-4 fw-bold ms-2 rounded-pill shadow-sm" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('todos.create') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-bold">
                                <i class="fa fa-plus me-2"></i> Tugas Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-0">
                    @if($todos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0;">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-4 ps-4 text-uppercase text-muted small fw-bold border-0" width="5%">#</th>
                                        <th class="py-4 text-uppercase text-muted small fw-bold border-0" width="40%">Judul Tugas</th>
                                        <th class="py-4 text-uppercase text-muted small fw-bold border-0 text-center" width="20%">Status</th>
                                        <th class="py-4 text-uppercase text-muted small fw-bold border-0 text-end pe-4" width="35%">Aksi Cepat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todos as $index => $todo)
                                    <tr class="{{ $todo->is_completed ? 'bg-light' : '' }}"> 
                                        <td class="ps-4 border-bottom-0">
                                            <span class="fw-bold text-secondary">{{ $todos->firstItem() + $index }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('todos.show', $todo->id) }}" class="fw-bold text-decoration-none {{ $todo->is_completed ? 'text-decoration-line-through text-muted' : 'text-dark' }}">
                                                    {{ $todo->title }}
                                                </a>
                                                <small class="text-muted text-truncate mb-1" style="max-width: 300px;">
                                                    {{ $todo->description ?? 'Tidak ada deskripsi' }}
                                                </small>
                                                <div class="d-flex align-items-center mt-1">
                                                    <small class="text-muted" style="font-size: 0.75rem;">
                                                        <i class="fa-regular fa-clock me-1 text-primary"></i> 
                                                        {{ $todo->created_at->format('d M Y, H:i') }}
                                                    </small>
                                                    <span class="mx-2 text-muted" style="font-size: 0.75rem;">•</span>
                                                    <small class="text-secondary fst-italic" style="font-size: 0.75rem;">
                                                        {{ $todo->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-bottom-0">
                                            @if($todo->is_completed)
                                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                                    <i class="fa-solid fa-check me-1"></i> Selesai
                                                </span>
                                            @else
                                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">
                                                    <i class="fa-solid fa-hourglass-half me-1"></i> Proses
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4 border-bottom-0">
                                            <div class="d-flex justify-content-end gap-2">
                                                
                                                
                                                <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($todo->is_completed)
                                                        
                                                        <button type="submit" class="btn btn-secondary btn-sm rounded-circle shadow-sm" title="Tandai Belum Selesai" style="width: 32px; height: 32px;">
                                                            <i class="fa-solid fa-rotate-left"></i>
                                                        </button>
                                                    @else
                                                        
                                                        <button type="submit" class="btn btn-success btn-sm rounded-circle shadow-sm" title="Tandai Selesai" style="width: 32px; height: 32px;">
                                                            <i class="fa-solid fa-check"></i>
                                                        </button>
                                                    @endif
                                                </form>

                                                
                                                <a href="{{ route('todos.show', $todo->id) }}" class="btn btn-white border text-primary btn-sm rounded-circle shadow-sm" title="Lihat Detail" style="width: 32px; height: 32px;">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                
                                                <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-white border text-warning btn-sm rounded-circle shadow-sm" title="Edit" style="width: 32px; height: 32px;">
                                                    <i class="fa fa-pen"></i>
                                                </a>

                                                
                                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-white border text-danger btn-sm rounded-circle shadow-sm" onclick="return confirm('Yakin ingin menghapus tugas ini?')" title="Hapus" style="width: 32px; height: 32px;">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-end p-4">
                            {{ $todos->links('pagination::bootstrap-5') }}
                        </div>

                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fa-regular fa-clipboard fa-3x text-muted opacity-50"></i>
                            </div>
                            <h5 class="fw-bold text-muted">Belum ada tugas</h5>
                            <p class="text-muted small">Tugas yang Anda cari tidak ditemukan.</p>
                            @if(request('search'))
                                <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill mt-2">Reset Pencarian</a>
                            @else
                                <a href="{{ route('todos.create') }}" class="btn btn-outline-primary btn-sm rounded-pill mt-2">Buat Tugas Pertama</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="text-center mt-4 text-muted small opacity-75">
                &copy; {{ date('Y') }} ToDoApp Project
            </div>
        </div>
    </div>
</div>
@endsection