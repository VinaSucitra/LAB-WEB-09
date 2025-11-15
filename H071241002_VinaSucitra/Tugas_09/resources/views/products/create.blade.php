@extends('layouts.app')

@section('content')
<style>

    .form-control, .form-select, .form-label {
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

    .table-stock thead th {
        background-color: var(--pink-dark); 
        color: #fff;
        font-weight: 600;
        border: none;
    }
    
    .table-stock {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .btn-remove-row {
        background-color: #EF4444;
        border-color: #EF4444;
        color: #fff;
        border-radius: 6px;
    }
    .btn-remove-row:hover {
        background-color: #DC2626;
        border-color: #DC2626;
    }
    
</style>

<div class="container mt-5">
    <div class="card p-4 shadow-sm" style="border-radius: 15px; background: rgba(255, 255, 255, 0.9);">
        <h2 class="mb-4">➕ Tambah Produk Baru</h2>
        
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select id="category_id" name="category_id" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Harga (Rp)</label>
                        <input type="number" id="price" name="price" class="form-control" required min="0" step="0.01">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Berat (kg)</label>
                        <input type="number" id="weight" name="weight" class="form-control" required step="0.01">
                    </div>

                    <div class="mb-3">
                        <label for="size" class="form-label">Ukuran</label>
                        <input type="text" id="size" name="size" class="form-control">
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <h4 class="mb-3">Stok di Gudang (Pencatatan Awal)</h4>
            
            <div class="table-stock mb-3">
                <table class="table table-striped mb-0" id="warehouseTable">
                    <thead>
                        <tr>
                            <th>Gudang</th>
                            <th>Jumlah Stok</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="warehouseRows">
                        <tr>
                            <td>
                                <select name="warehouses[]" class="form-select" required>
                                    <option value="">-- Pilih Gudang --</option>
                                    @foreach($warehouses as $wh)
                                        <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantities[]" class="form-control" min="0" value="0">
                            </td>
                            <td>
                                {{-- Tombol Hapus baris pertama di-disable karena minimum harus ada satu gudang --}}
                                <button type="button" class="btn btn-remove-row btn-sm" onclick="removeRow(this)" disabled>Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-secondary btn-sm mb-4" onclick="addRow()">+ Tambah Gudang Lain</button>
            <br>
            
            <button type="submit" class="btn btn-primary btn-lg mt-3">Simpan Produk Baru</button>
        </form>
    </div>
</div>

<script>
    function addRow() {
        const tableBody = document.getElementById('warehouseRows');
        const newRow = document.createElement('tr');

        const selectOptions = document.querySelector('#warehouseRows select').innerHTML;

        newRow.innerHTML = `
            <td>
                <select name="warehouses[]" class="form-select" required>
                    ${selectOptions}
                </select>
            </td>
            <td>
                <input type="number" name="quantities[]" class="form-control" min="0" value="0">
            </td>
            <td>
                <button type="button" class="btn btn-remove-row btn-sm" onclick="removeRow(this)">Hapus</button>
            </td>
        `;
        tableBody.appendChild(newRow);

        updateRemoveButtons();
    }

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        const tableBody = document.getElementById('warehouseRows');
 
        if (tableBody.rows.length > 1) {
            row.remove();
            updateRemoveButtons();
        } else {
            console.warn("Tidak dapat menghapus. Harus ada minimal satu gudang."); 
        }
    }

    function updateRemoveButtons() {
        const tableBody = document.getElementById('warehouseRows');
        const rows = tableBody.getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const button = rows[i].querySelector('.btn-remove-row');
            if (button) {
                button.disabled = (rows.length === 1); 
            }
        }
    }

    document.addEventListener('DOMContentLoaded', updateRemoveButtons);
</script>
@endsection