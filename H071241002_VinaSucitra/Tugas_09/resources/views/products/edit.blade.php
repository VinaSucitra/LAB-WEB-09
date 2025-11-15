@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Produk</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>

                <label class="form-label mt-3">Kategori</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <label class="form-label mt-3">Harga</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required step="0.01">
            </div>

            <div class="col-md-6">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control">{{ $product->detail->description ?? '' }}</textarea>

                <label class="form-label mt-3">Berat (kg)</label>
                <input type="number" name="weight" class="form-control" value="{{ $product->detail->weight ?? '' }}" required step="0.01">

                <label class="form-label mt-3">Ukuran</label>
                <input type="text" name="size" class="form-control" value="{{ $product->detail->size ?? '' }}">
            </div>
        </div>

        <hr class="my-4">

        <h4>Stok di Gudang</h4>
        <table class="table" id="warehouseTable">
            <thead>
                <tr>
                    <th>Gudang</th>
                    <th>Jumlah Stok</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="warehouseRows">
                @foreach($warehouses as $wh)
                    @php
                        $pivot = $product->warehouses->firstWhere('id', $wh->id);
                        $qty = $pivot ? $pivot->pivot->quantity : 0;
                    @endphp
                    <tr>
                        <td>
                            <input type="hidden" name="warehouses[]" value="{{ $wh->id }}">
                            {{ $wh->name }}
                        </td>
                        <td>
                            <input type="number" name="quantities[]" class="form-control" value="{{ $qty }}" min="0">
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
