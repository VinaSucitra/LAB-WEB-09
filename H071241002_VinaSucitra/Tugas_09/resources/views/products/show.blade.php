@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detail Produk</h2>
    <div class="card shadow-sm mt-4" style="border-radius: 12px;">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ $product->name }}</h4>
            <p><strong>Kategori:</strong> {{ $product->category->name ?? 'Tidak ada kategori' }}</p>
            <p><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            <p><strong>Berat:</strong> {{ $product->detail->weight ?? '-' }} kg</p>
            <p><strong>Ukuran:</strong> {{ $product->detail->size ?? '-' }}</p>
            <p><strong>Deskripsi:</strong> {{ $product->detail->description ?? 'Tidak ada deskripsi' }}</p>

            <h5 class="mt-4">📦 Stok di Gudang</h5>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nama Gudang</th>
                        <th>Lokasi</th>
                        <th>Jumlah Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product->warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->name }}</td>
                            <td>{{ $warehouse->location ?? '-' }}</td>
                            <td>{{ $warehouse->pivot->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada stok di gudang mana pun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>
@endsection
