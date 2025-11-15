@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Kategori</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        
        {{-- Perbaikan di sini untuk menampilkan error validasi 'name' --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input 
                type="text" 
                name="name" 
                id="name"
                {{-- 1. Tambahkan class is-invalid jika ada error --}}
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name') }}" 
                required
            >
            {{-- 2. Tampilkan pesan error --}}
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection