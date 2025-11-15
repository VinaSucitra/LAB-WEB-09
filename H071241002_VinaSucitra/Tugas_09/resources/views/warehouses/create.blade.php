@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Gudang</h2>
    <form action="{{ route('warehouses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Gudang</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <textarea name="location" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
