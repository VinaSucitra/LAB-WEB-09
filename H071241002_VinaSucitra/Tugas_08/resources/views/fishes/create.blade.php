@extends('layouts.app')

@section('title', 'Tambah Ikan Baru')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/create-fish.css') }}">
@endpush

@section('content')
<div class="create-container">
    <div class="create-card">
        <h1>🐠 Tambah Ikan Baru</h1>
        <p class="subtitle">Isi data ikan baru dan biarkan laut menyimpan rahasianya 🌊</p>

        {{-- 🔴 Tampilkan semua error umum di atas form --}}
        @if ($errors->any())
            <div class="error-box" style="background-color:#fee2e2; color:#b91c1c; padding:10px; border-radius:8px; margin-bottom:15px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fishes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Ikan:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Rarity:</label>
                <select name="rarity" class="form-select" required>
                    <option value="">-- Pilih Rarity --</option>
                    @foreach(['Common','Uncommon','Rare','Epic','Legendary', 'Mythic', 'Secret'] as $rarity)
                        <option value="{{ $rarity }}" {{ old('rarity') == $rarity ? 'selected' : '' }}>{{ $rarity }}</option>
                    @endforeach
                </select>
                @error('rarity')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label>Berat Minimum (kg):</label>
                    <input type="number" step="0.01" name="base_weight_min" value="{{ old('base_weight_min') }}" class="form-control" required>
                    @error('base_weight_min')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Berat Maksimum (kg):</label>
                    <input type="number" step="0.01" name="base_weight_max" value="{{ old('base_weight_max') }}" class="form-control" required>
                    {{-- 🟢 Pesan error akan muncul di sini jika max <= min --}}
                    @error('base_weight_max')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label>Harga Jual per Kg (Coins):</label>
                    <input type="number" name="sell_price_per_kg" value="{{ old('sell_price_per_kg') }}" class="form-control" required>
                    @error('sell_price_per_kg')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Peluang Tertangkap (%):</label>
                    <input type="number" step="0.01" name="catch_probability" value="{{ old('catch_probability') }}" class="form-control" required>
                    @error('catch_probability')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="btn-container">
                <button type="submit" class="btn btn-save">💾 Simpan</button>
                <a href="{{ route('fishes.index') }}" class="btn btn-back">⬅️ Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
