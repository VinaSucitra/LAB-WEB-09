@extends('layouts.app')

@section('content')
<style>
    :root {
        --pink-dark: #B91C80; 
        --purple-soft: #8B5CF6; 
        --pink-soft: #FBCFE8; 
        --purple-dark: #5A0E63; 
    

    .table-responsive-custom {
        border-radius: 12px;
        overflow: hidden; 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .table {
        margin-bottom: 0; 
    }

    .table-custom thead {
        background-color: var(--pink-dark); 
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
        padding: 4px 8px; 
    }

    .btn-edit:hover {
        background-color: var(--purple-dark);
        border-color: var(--purple-dark);
        color: #fff;
    }

    .btn-view {
        background-color: #E9D5FF; 
        border-color: #C084FC; 
        color: #8B5CF6; 
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s ease;
        padding: 4px 8px; 
    }
    
    .btn-view:hover {
        background-color: #C084FC;
        border-color: #C084FC;
        color: #fff;
    }


    .btn-delete {
        background-color: var(--pink-dark); 
        border-color: var(--pink-dark);
        color: #fff;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s ease;
        padding: 4px 8px; 
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
    <h2>Daftar Kategori Produk</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">+ Tambah Kategori</a>

    @if (session('success'))
        <div class="alert-success-custom">{{ session('success') }}</div>
    @endif

    <div class="table-responsive-custom">
        <table class="table table-striped table-hover table-custom table-hover-custom align-middle">
            <thead class="table-custom">
                <tr>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th style="width: 200px;">Aksi</th> 
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        
                        <td class="d-flex align-items-center gap-1">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-edit btn-sm">Edit</a>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-view btn-sm">Lihat</a>

                            <button type="button" class="btn btn-delete btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmDeleteModal" 
                                    onclick="setDeleteAction('{{ route('categories.destroy', $category->id) }}', '{{ $category->name }}')">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <span class="fw-bold">Belum ada kategori yang terdaftar.</span> Silakan tambahkan kategori baru!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $categories->links() }}
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none;">
            <div class="modal-header" style="background-color: var(--pink-dark); color: #fff; border-top-left-radius: 12px; border-top-right-radius: 12px; border-bottom: none;">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan Kategori</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 Apakah Anda yakin ingin menghapus kategori <span id="categoryNameModal" class="fw-bold"></span> ini? 
            </div>
            <div class="modal-footer" style="border-top: none;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" style="border-radius: 6px;">Ya, Hapus Kategori</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteAction(url, name) {
        const deleteForm = document.getElementById('deleteForm');
        const nameDisplay = document.getElementById('categoryNameModal');

        deleteForm.action = url;

        nameDisplay.textContent = name ? `'${name}'` : 'ini';
    }
</script>
@endsection