@extends('layouts.app')

@section('title', 'Daftar Dosen')

@section('content')
<div class="container-fluid">
    <h1 class="dashboard-heading mt-4">Daftar Dosen</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Form -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-filter me-2"></i>Filter Dosen
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('dosen.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label for="nidn" class="form-label">NIDN</label>
                            <input type="text" class="form-control" id="nidn" name="nidn" value="{{ request('nidn') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ request('nama') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ request('email') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync-alt me-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end align-items-center">
            <a href="{{ route('dosen.create') }}" class="btn btn-success rounded-circle me-2 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                <i class="fas fa-plus text-white"></i>
            </a>
            <button class="btn btn-primary rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                <i class="fas fa-save text-white"></i>
            </button>
        </div>
    </div>

    <!-- Dosen Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Gelar</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Jabatan</th>
                            <th>Kompetensi</th>
                            <th>Prodi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dosens as $dosen)
                        <tr>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->gelar }}</td>
                            <td>{{ $dosen->jenis_kelamin }}</td>
                            <td>{{ $dosen->email }}</td>
                            <td>{{ $dosen->kontak }}</td>
                            <td>{{ $dosen->jabatan }}</td>
                            <td>{{ $dosen->kompetensi }}</td>
                            <td>{{ $dosen->prodi }}</td>
                            <td>
                                <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-outline-success btn-sm">Edit</a>
                                <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data dosen ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Controls -->
                <div class="d-flex justify-content-end align-items-center mt-3">
                    <button class="btn btn-primary me-2" onclick="navigateToPage('{{ $dosens->previousPageUrl() }}')" {{ $dosens->onFirstPage() ? 'disabled' : '' }}>
                        <i class="fas fa-chevron-left"></i> Halaman Sebelumnya
                    </button>
                    <button class="btn btn-primary" onclick="navigateToPage('{{ $dosens->nextPageUrl() }}')" {{ $dosens->hasMorePages() ? '' : 'disabled' }}>
                        Halaman Selanjutnya <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #def4ff;
    }
    .dashboard-heading {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }
    .table thead th {
        background-color: rgb(0, 114, 202) !important;
        color: white !important;
    }
</style>
@endsection

@section('scripts')
<script>
    function navigateToPage(url) {
        if (url) {
            window.location.href = url;
        }
    }
</script>
@endsection
