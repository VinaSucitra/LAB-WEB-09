@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detail Kategori Produk</h2>
    <div class="card shadow-sm mt-4" style="border-radius: 12px;">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ $category->name }}</h4>
            <p><strong>Deskripsi:</strong> {{ $category->description ?? 'Tidak ada deskripsi' }}</p>

            <h5 class="mt-4">📦 Daftar Produk dalam Kategori Ini</h5>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Ukuran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category->products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->detail->weight ?? '-' }} kg</td>
                            <td>{{ $product->detail->size ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada produk dalam kategori ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>
@endsection
