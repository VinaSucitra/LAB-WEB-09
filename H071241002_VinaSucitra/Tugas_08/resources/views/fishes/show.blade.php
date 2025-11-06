@extends('layouts.app')

@section('title', 'Detail Ikan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/show-fish.css') }}">
@endpush

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center py-16 px-6">

    <div class="fish-card w-full max-w-3xl">

        <h1>🐠 Detail Ikan</h1>
        <p class="subtitle">Menyelami informasi lengkap tentang ikan pilihanmu 🌊</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-lg">
            <div class="space-y-3">
                <p><span class="info-label">Nama Ikan:</span> <span class="info-value">{{ ucfirst($fish->name) }}</span></p>
                <p><span class="info-label">Rarity:</span> <span class="info-value">{{ $fish->rarity }}</span></p>
                <p><span class="info-label">Berat Minimum:</span> <span class="info-value">{{ number_format($fish->base_weight_min, 2) }} kg</span></p>
                <p><span class="info-label">Berat Maksimum:</span> <span class="info-value">{{ number_format($fish->base_weight_max, 2) }} kg</span></p>
            </div>

            <div class="space-y-3">
                <p><span class="info-label">Harga per Kg:</span> <span class="info-value">{{ number_format($fish->sell_price_per_kg, 0, ',', '.') }} Coins</span></p>
                <p><span class="info-label">Peluang Tertangkap:</span> <span class="info-value">{{ number_format($fish->catch_probability, 2) }}%</span></p>
                <p><span class="info-label">Deskripsi:</span> 
                    <span class="info-value">{{ $fish->description ?? 'Tidak ada deskripsi.' }}</span>
                </p>
            </div>
        </div>

        <div class="divider"></div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('fishes.edit', $fish->id) }}" class="btn btn-edit">✏️ Edit</a>

            <form action="{{ route('fishes.destroy', $fish->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ikan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">🗑️ Hapus</button>
            </form>

            <a href="{{ route('fishes.index') }}" class="btn btn-back">⬅️ Kembali</a>
        </div>
    </div>
</div>
@endsection
