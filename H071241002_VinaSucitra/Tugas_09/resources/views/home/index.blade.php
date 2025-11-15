@extends('layouts.app')

@section('content')
<style>

    body {
        background: linear-gradient(135deg, #FFF0F5, #F0E6FA); 
        font-family: 'Inter', sans-serif;
    }

    .welcome-container {
        background: #FCE7F6; 
        padding: 40px;
        margin-bottom: 40px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(252, 231, 246, 0.6);
        border: 1px solid #FBCFE8;
    }

    .welcome-title {
        font-weight: 800;
        font-size: 3rem; 
        color: #B91C80; 
        margin-bottom: 5px;
        line-height: 1.2;
    }

    .welcome-subtitle {
        color: #701A75; 
        font-size: 1.2rem;
        font-weight: 500;
    }

    .card-dash {
        border: none;
        border-radius: 16px;
        padding: 20px; 
        color: #fff;
        min-height: 160px; 
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .card-dash::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: rotate(45deg);
    }

    .card-dash:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .card-pink { 
        background: linear-gradient(145deg, #F9A8D4, #EC4899); 
    }
    .card-purple { 
        background: linear-gradient(145deg, #C084FC, #9333EA); 
    }
    .card-peach { 
        background: linear-gradient(145deg, #FDBA74, #F97316); 
    }
    .card-cyan {
        background: linear-gradient(145deg, #67E8F9, #06B6D4); 
    }


    .card-dash h3 {
        font-weight: 600;
        font-size: 1rem; 
        opacity: 0.9;
    }

    .card-dash h1 {
        font-weight: 800;
        font-size: 2.2rem; 
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .card-dash p {
        font-size: 0.8rem;
        opacity: 0.9;
        flex-grow: 1; 
    }

    .card-dash a {
        display: inline-block;
        padding: 6px 15px; 
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.75rem;
        transition: background 0.3s ease;
        white-space: nowrap;
    }

    .card-dash a:hover {
        background: rgba(255, 255, 255, 0.4);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-in-container {
        animation: fadeIn 0.8s ease forwards;
        animation-delay: 0.1s;
    }

    @media (min-width: 992px) {
        .col-lg-3-custom {
            flex: 0 0 auto;
            width: 25%;
        }
    }
</style>

<div class="container mt-5 fade-in-container">
    <div class="welcome-container">
        <h1 class="welcome-title">Selamat Datang di Sistem Manajemen! 👋</h1>
        <p class="welcome-subtitle">Pantau dan kelola inventaris Anda dengan efisien. Semua data terkini tersedia di sini.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3 col-lg-3-custom">
            <div class="card-dash card-pink">
                <div>
                    <h3>Total Produk</h3>
                    <h1>{{ \App\Models\Product::count() }}</h1>
                    <p>Jumlah semua produk aktif yang tercatat di dalam sistem.</p>
                </div>
                <a href="{{ route('products.index') }}">Lihat Detail Produk →</a>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 col-lg-3-custom">
            <div class="card-dash card-cyan">
                <div>
                    <h3>Total Kategori</h3>
                    <h1>{{ \App\Models\Category::count() }}</h1>
                    <p>Semua kategori yang digunakan untuk mengelompokkan produk.</p>
                </div>
                <a href="{{ route('categories.index') }}">Kelola Kategori →</a>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 col-lg-3-custom">
            <div class="card-dash card-purple">
                <div>
                    <h3>Gudang Aktif</h3>
                    <h1>{{ \App\Models\Warehouse::count() }}</h1>
                    <p>Total lokasi penyimpanan dan distribusi produk Anda.</p>
                </div>
                <a href="{{ route('warehouses.index') }}">Kelola Lokasi Gudang →</a>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 col-lg-3-custom">
            <div class="card-dash card-peach">
                <div>
                    <h3>Status Stok</h3>
                    <h1>Kontrol</h1>
                    <p>Lakukan transfer, cek inventaris, dan pantau batas minimum stok.</p>
                </div>
                <a href="{{ route('stocks.index') }}">Cek & Atur Stok →</a>
            </div>
        </div>
    </div>


</div>
@endsection