@extends('layouts.app')

@section('title', 'CPMK')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">CPMK</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-end align-items-center mb-3">
            <div class="d-flex">
                <a href="{{ route('cpmk.create') }}"
                    class="btn btn-success rounded-circle me-2 d-flex justify-content-center align-items-center"
                    style="width: 40px; height: 40px;">
                    <i class="fas fa-plus text-white"></i>
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-filter me-2"></i>Filter CPMK
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('cpmk.index') }}">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label for="kode_cpmk" class="form-label">Kode CPMK</label>
                                    <input type="text" name="kode_cpmk" class="form-control"
                                        value="{{ request('kode_cpmk') }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="kode_cpl" class="form-label">Kode CPL</label>
                                    <select name="kode_cpl" class="form-control">
                                        <option value="">Semua CPL</option>
                                        @foreach ($availableCpls as $cpl)
                                            <option value="{{ $cpl->kode_cpl }}"
                                                {{ request('kode_cpl') == $cpl->kode_cpl ? 'selected' : '' }}>
                                                {{ $cpl->kode_cpl }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                                    <select name="mata_kuliah" class="form-control">
                                        <option value="">Semua MK</option>
                                        @foreach ($availableMatakuliahs as $mk)
                                            <option value="{{ $mk->kode_mk }}"
                                                {{ request('mata_kuliah') == $mk->kode_mk ? 'selected' : '' }}>
                                                {{ $mk->kode_mk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="pic" class="form-label">PIC</label>
                                    <select name="pic" class="form-control">
                                        <option value="">Semua PIC</option>
                                        @foreach ($availablePics as $pic)
                                            <option value="{{ $pic }}"
                                                {{ request('pic') == $pic ? 'selected' : '' }}>
                                                {{ $pic }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="bobot" class="form-label">Bobot</label>
                                    <input type="number" name="bobot" class="form-control"
                                        value="{{ request('bobot') }}">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2 w-100">
                                        <i class="fas fa-search me-1"></i>Filter
                                    </button>
                                    <a href="{{ route('cpmk.index') }}" class="btn btn-secondary w-100 mt-2">
                                        <i class="fas fa-sync-alt me-1"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #2f5f98; color: #fff;">
                            <tr>
                                <th class="text-start">Kode CPMK</th>
                                <th class="text-start">Deskripsi</th>
                                <th class="text-start">Kode CPL</th>
                                <th class="text-start">Mata Kuliah</th>
                                <th class="text-start">Bobot</th>
                                <th class="text-start">PIC</th>
                                <th class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cpmks as $cpmk)
                                <tr>
                                    <td class="text-start">{{ $cpmk->kode_cpmk }}</td>
                                    <td class="text-start">{{ $cpmk->deskripsi }}</td>
                                    <td class="text-start">{{ $cpmk->kode_cpl }}</td>
                                    <td class="text-start">{{ $cpmk->mata_kuliah }}</td>
                                    <td class="text-start">{{ $cpmk->bobot }}</td>
                                    <td class="text-start">{{ $cpmk->pic }}</td>
                                    <td class="text-start">
                                        <a href="#" class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editCpmkModal" 
                                            data-id="{{ $cpmk->id }}"
                                            data-kode_cpl="{{ $cpmk->kode_cpl }}"
                                            data-kode_cpmk="{{ $cpmk->kode_cpmk }}"
                                            data-deskripsi="{{ $cpmk->deskripsi }}" 
                                            data-mata_kuliah="{{ $cpmk->mata_kuliah }}" 
                                            data-bobot="{{ $cpmk->bobot }}"
                                            data-pic="{{ $cpmk->pic }}">
                                            Edit
                                        </a>
                                        <form action="{{ route('cpmk.destroy', $cpmk->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus CPMK ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-start">Tidak ada data CPMK</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit CPMK Modal -->
    <div class="modal fade" id="editCpmkModal" tabindex="-1" aria-labelledby="editCpmkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCpmkModalLabel">Edit CPMK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_kode_cpl" class="form-label">CPL</label>
                            <select class="form-control" id="edit_kode_cpl" name="kode_cpl" required>
                                @foreach ($cpls as $cpl)
                                    <option value="{{ $cpl->kode_cpl }}">{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kode_cpmk" class="form-label">Kode CPMK</label>
                            <input type="text" class="form-control" id="edit_kode_cpmk" name="kode_cpmk" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_mata_kuliah" class="form-label">Mata Kuliah</label>
                            <select class="form-control" id="edit_mata_kuliah" name="mata_kuliah" required>
                                @foreach ($matakuliahs as $matakuliah)
                                    <option value="{{ $matakuliah->kode_mk }}">{{ $matakuliah->kode_mk }} -
                                        {{ $matakuliah->nama_mk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_bobot" class="form-label">Bobot</label>
                            <input type="number" class="form-control" id="edit_bobot" name="bobot" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_pic" class="form-label">PIC</label>
                            <input type="text" class="form-control" id="edit_pic" name="pic" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: #def4ff;
        }

        .table thead {
            background-color: #2f5f98 !important;
            color: #fff !important;
        }

        .table th {
            background-color: #2f5f98 !important;
            color: #fff !important;
        }

        .btn-outline-info {
            color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-outline-info:hover {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        /* Fix for modal overlay */
        .modal-backdrop {
            z-index: 1040 !important;
        }
        .modal {
            z-index: 1050 !important;
        }
    </style>
@endsection

@section('scripts')
    <!-- Load Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Edit Modal Handler
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editCpmkModal');
            
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const form = this.querySelector('#editForm');
                    
                    // Set form action
                    form.action = '/cpmk/' + button.getAttribute('data-id');
                    
                    // Fill form fields
                    document.getElementById('edit_kode_cpl').value = button.getAttribute('data-kode_cpl');
                    document.getElementById('edit_kode_cpmk').value = button.getAttribute('data-kode_cpmk');
                    document.getElementById('edit_mata_kuliah').value = button.getAttribute('data-mata_kuliah');
                    document.getElementById('edit_deskripsi').value = button.getAttribute('data-deskripsi');
                    document.getElementById('edit_pic').value = button.getAttribute('data-pic');
                    document.getElementById('edit_bobot').value = button.getAttribute('data-bobot');
                });
            }
            
            // CPL Number Preview for Add Form
            const cplSelect = document.getElementById('kode_cpl');
            const cpmkInput = document.getElementById('kode_cpmk');
            
            if (cplSelect && cpmkInput) {
                const preview = document.createElement('small');
                preview.className = 'form-text text-primary mt-1';
                cpmkInput.parentNode.appendChild(preview);

                function updatePreview() {
                    const cplCode = cplSelect.value;
                    const cplNumber = cplCode.replace('CPL', '');
                    const cpmkNum = cpmkInput.value.padStart(3, '0');
                    preview.textContent = `Kode CPMK akan menjadi: CPMK${cplNumber}${cpmkNum}`;
                }

                cplSelect.addEventListener('change', updatePreview);
                cpmkInput.addEventListener('input', updatePreview);
            }
        });
    </script>
@endsection