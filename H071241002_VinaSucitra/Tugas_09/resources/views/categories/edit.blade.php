@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Kategori</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- Perbaikan di sini untuk Nama Kategori --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input 
                type="text" 
                name="name" 
                id="name"
                {{-- 1. Tambahkan class is-invalid jika ada error --}}
                class="form-control @error('name') is-invalid @enderror" 
                {{-- 2. Gunakan old() untuk input lama, dengan fallback ke data kategori saat ini --}}
                value="{{ old('name', $category->name) }}" 
                required
            >
            {{-- 3. Tampilkan pesan error --}}
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        {{-- Perbaikan di sini untuk Deskripsi (opsional, jika ada aturan validasi deskripsi) --}}
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection