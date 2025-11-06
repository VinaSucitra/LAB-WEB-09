@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/index-fish.css') }}">
@endpush

@section('content')
<div class="overlay">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-extrabold flex items-center gap-2">
            <i class="bi bi-list-task"></i> Daftar Ikan Laut 🐟
        </h2>

        <a href="{{ route('fishes.create') }}"
           class="btn-blue px-5 py-3 shadow-md inline-flex items-center gap-2">
           <i class="bi bi-plus-circle"></i> Tambah Ikan
        </a>
    </div>

    <form method="GET" action="{{ route('fishes.index') }}" class="flex gap-4 mb-6 flex-wrap">
        <select name="rarity" class="w-1/4">
            <option value="">Semua Rarity</option>
            @foreach(['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'] as $r)
                <option value="{{ $r }}" {{ request('rarity') == $r ? 'selected' : '' }}>{{ $r }}</option>
            @endforeach
        </select>

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama ikan..."
            class="flex-1" />

        <button type="submit" class="btn-filter px-5 py-3">cari</button>
    </form>

    <div class="table-container">
        <table class="min-w-full text-left text-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Rarity</th>
                    <th class="px-6 py-3">Berat (kg)</th>
                    <th class="px-6 py-3">Harga/kg</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fishes as $fish)
                    <tr>
                        <td class="px-6 py-4 font-semibold">{{ $fish->name }}</td>
                        <td class="px-6 py-4">{{ $fish->rarity }}</td>
                        <td class="px-6 py-4">{{ $fish->base_weight_min }} - {{ $fish->base_weight_max }}</td>
                        <td class="px-6 py-4">{{ $fish->sell_price_per_kg }}</td>
                        <td class="px-6 py-4 text-center flex gap-2 justify-center">
                            <a href="{{ route('fishes.show', $fish->id) }}" class="btn-view px-3 py-2 text-xs flex items-center gap-2">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                            <a href="{{ route('fishes.edit', $fish->id) }}" class="btn-edit px-3 py-2 text-xs flex items-center gap-2">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('fishes.destroy', $fish->id) }}" method="POST" onsubmit="return confirm('Yakin hapus ikan ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete px-3 py-2 text-xs flex items-center gap-2">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-400">Belum ada data ikan 🐠</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $fishes->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
