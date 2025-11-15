@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Gudang</h2>
    <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Gudang</label>
            <input type="text" name="name" class="form-control" value="{{ $warehouse->name }}" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <textarea name="location" class="form-control">{{ $warehouse->location }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
