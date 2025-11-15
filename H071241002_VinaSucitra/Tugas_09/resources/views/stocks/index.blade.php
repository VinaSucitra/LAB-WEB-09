@extends('layouts.app')

@section('content')
<style>
    /* ... (CSS Anda sebelumnya) ... */
    :root {
        --pink-dark: #B91C80; 
        --purple-soft: #8B5CF6; 
        --pink-soft: #FBCFE8; 
        --purple-dark: #5A0E63; 
        --text-dark: #5A0E63;
    }
    
    .table-responsive-custom {
        border-radius: 12px;
        overflow: hidden; 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    
    .table {
        margin-bottom: 0; 
    }

    .table-custom thead {
        background-color: var(--pink-dark); 
        color: #fff;
    }
    
    .table-custom th {
        border: none !important;
        font-weight: 600;
        padding: 12px 15px;
    }
    
    .table-hover-custom tbody tr:hover {
        background-color: #F8E8F8; 
    }

    .alert-success-custom {
        background-color: #F0FDF4; 
        color: #065F46; 
        border-color: #DCFCE7;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-danger-custom {
        background-color: #FEF2F2; 
        color: #991B1B; 
        border-color: #FECACA;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .form-control, .form-select {
        border-radius: 8px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #B91C80; 
        box-shadow: 0 0 0 0.25rem rgba(185, 28, 128, 0.25);
    }
    
    .form-label {
        font-weight: 600;
        color: var(--text-dark); 
    }

    .btn-transfer {
        background-color: var(--purple-soft);
        border-color: var(--purple-soft);
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    
    .btn-transfer:hover {
        background-color: var(--purple-dark);
        border-color: var(--purple-dark);
        color: #fff;
    }

    .btn-filter {
        background-color: var(--pink-dark);
        border-color: var(--pink-dark);
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    
    .btn-filter:hover {
        background-color: #A81A72;
        border-color: #A81A72;
        color: #fff;
    }

    .bg-purple {
        background-color: var(--purple-soft) !important;
        color: #fff;
    }
    
    .bg-danger {
        background-color: #DC2626 !important; 
        color: #fff;
    }
    
</style>

<div class="container mt-5">
    <h2>Manajemen Stok Produk</h2>

    {{-- Perbaiki bagian pesan error umum --}}
    @if (session('success'))
        <div class="alert-success-custom">{{ session('success') }}</div>
    @endif
    {{-- Jika ada error validasi Laravel, tampilkan secara umum di atas form --}}
    @if ($errors->any() && !session('error_message'))
        <div class="alert-danger-custom">
            Mohon perbaiki kesalahan berikut pada form Operasi Stok.
        </div>
    @endif
    
    {{-- Tambahkan penanganan untuk pesan error kustom (jika Anda menggunakan return redirect()->back()->with('error_message')) --}}
    @if (session('error_message'))
        <div class="alert-danger-custom">{{ session('error_message') }}</div>
    @endif

    <form method="GET" action="{{ route('stocks.index') }}" class="row g-2 mb-4 align-items-end">
        <div class="col-md-4">
            <label for="warehouse_select" class="form-label">Filter Berdasarkan Gudang</label>
            <select id="warehouse_select" name="warehouse_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua Gudang --</option>
                @foreach($warehouses as $wh)
                    <option value="{{ $wh->id }}" {{ $selectedWarehouse == $wh->id ? 'selected' : '' }}>
                        {{ $wh->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-filter">Tampilkan</button>
        </div>
    </form>

    <div class="table-responsive-custom mb-5">
        {{-- Tabel Stok (Tidak Diubah) --}}
        <table class="table table-striped table-hover table-custom table-hover-custom align-middle">
            <thead class="table-custom">
                <tr>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Gudang</th>
                    <th>Jumlah Stok</th>
                </tr>
            </thead>
            <tbody>
                @php $isEmpty = true; @endphp
                @foreach ($products as $product)
                    @foreach($product->warehouses as $wh)
                        @if (!$selectedWarehouse || $selectedWarehouse == $wh->id)
                            @php $isEmpty = false; @endphp
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $wh->name }}</td>
                                <td>{{ $wh->pivot->quantity }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                
                @if ($isEmpty)
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            @if ($selectedWarehouse)
                                Tidak ada data stok untuk gudang yang dipilih.
                            @else
                                Tidak ada data stok produk di semua gudang.
                            @endif
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <hr class="my-5">

    <h4 class="mb-4">Operasi Stok (Tambah / Kurang)</h4>
    <div class="card p-4 shadow-sm" style="border-radius: 15px; background: rgba(255, 255, 255, 0.9);">
        <form method="POST" action="{{ route('stocks.transfer') }}" class="row g-3">
            @csrf
            
            {{-- Pilih Gudang --}}
            <div class="col-md-4">
                <label for="warehouse_id" class="form-label">Pilih Gudang</label>
                <select name="warehouse_id" id="warehouse_id" class="form-select @error('warehouse_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Gudang Tujuan/Asal --</option>
                    @foreach($warehouses as $wh)
                        <option value="{{ $wh->id }}" {{ old('warehouse_id') == $wh->id ? 'selected' : '' }}>{{ $wh->name }}</option>
                    @endforeach
                </select>
                 @error('warehouse_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pilih Produk --}}
            <div class="col-md-4">
                <label for="product_id" class="form-label">Pilih Produk</label>
                <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}" {{ old('product_id') == $prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Perubahan Stok (Ini yang paling penting) --}}
            <div class="col-md-3">
                <label for="quantity_change" class="form-label">Perubahan Stok</label>
                <input 
                    type="number" 
                    name="quantity_change" 
                    id="quantity_change"
                    class="form-control @error('quantity_change') is-invalid @enderror" 
                    placeholder="+10 (Tambah) atau -5 (Kurang)" 
                    value="{{ old('quantity_change') }}"
                    required
                >
                <small class="form-text text-muted">Gunakan nilai positif untuk menambah atau nilai negatif untuk mengurangi stok.</small>
                
                {{-- Tampilkan error di bawah field ini --}}
                @error('quantity_change')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-1 d-grid align-self-end">
                <button type="submit" class="btn btn-transfer">Proses</button>
            </div>
        </form>
    </div>
</div>
@endsection