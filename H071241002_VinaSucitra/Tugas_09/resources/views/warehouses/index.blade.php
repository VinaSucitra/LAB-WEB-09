@extends('layouts.app')

@section('content')
<style>

    .table-responsive-custom {
        border-radius: 12px;
        overflow: hidden; 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .table {
        margin-bottom: 0;
    }

    .table-custom thead {
        background-color: var(--pink-soft); 
        color: #fff;
    }
    
    .table-custom th {
        border: none !important;
        font-weight: 600;
        padding: 12px 15px;
    }

    .table-hover-custom tbody tr:hover {
        background-color: #F8E8F8; 
    }

    .btn-edit {
        background-color: var(--purple-soft); 
        border-color: var(--purple-soft);
        color: #fff;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .btn-edit:hover {
        background-color: #5A0E63; 
        border-color: #5A0E63;
        color: #fff;
    }

    .btn-delete {
        background-color: var(--pink-dark); 
        border-color: var(--pink-dark);
        color: #fff;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .btn-delete:hover {
        background-color: #A81A72; 
        border-color: #A81A72;
        color: #fff;
    }

    .alert-success-custom {
        background-color: #F0FDF4; 
        color: #065F46; 
        border-color: #DCFCE7;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

</style>

<div class="container mt-5">
    <h2>Daftar Gudang</h2>
    {{-- Tombol Tambah Gudang menggunakan .btn-primary --}}
    <a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-4">+ Tambah Gudang</a>

    @if (session('success'))
        <div class="alert-success-custom">{{ session('success') }}</div>
    @endif

    <div class="table-responsive-custom">
        <table class="table table-striped table-hover table-custom table-hover-custom align-middle">
            <thead class="table-custom">
                <tr>
                    <th>Nama Gudang</th>
                    <th>Lokasi</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($warehouses as $warehouse)
                    <tr>
                        <td>{{ $warehouse->name }}</td>
                        <td>{{ $warehouse->location }}</td>
                        <td>
                            <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-edit btn-sm">Edit</a>

                            <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-delete btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmDeleteModal" 
                                        onclick="setDeleteAction('{{ route('warehouses.destroy', $warehouse->id) }}')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <span class="fw-bold">Belum ada gudang yang terdaftar.</span> Silakan tambahkan gudang baru!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $warehouses->links() }}
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none;">
            <div class="modal-header" style="background-color: var(--pink-soft); color: #fff; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan Gudang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus gudang ini? 
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" style="border-radius: 6px;">Ya, Hapus Gudang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteAction(url) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = url;
    }
</script>
@endsection