<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
       
        :root {
            --pink-soft: #FCE7F6;
            --pink-dark: #B91C80;
            --purple-soft: #701A75;
            --text-dark: #5A0E63; 
            --navbar-gradient: linear-gradient(135deg, #ffb3d9, #cfa8ff, #a8e1ff);
            --soft-background-gradient: linear-gradient(135deg, #FFF0F5, #F0E6FA); 
        }
        
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--soft-background-gradient); 
            background-attachment: fixed; 
            color: var(--text-dark); 
        }

        a {
            color: var(--purple-soft); 
        }
        
        a:hover {
            color: var(--pink-dark);
        }

        .navbar {
            background: var(--navbar-gradient) !important;
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
        }

        .navbar-brand, .nav-link {
            transition: color 0.3s ease;
            color: var(--text-dark) !important;
            font-weight: 600;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--pink-dark) !important;
            border-bottom: 3px solid var(--pink-dark);
            padding-bottom: 5px;
        }

        main {
            flex-grow: 1;
        }

        .btn-primary {
            background-color: var(--pink-dark); 
            border-color: var(--pink-dark);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #A81A72; 
            border-color: #A81A72;
            box-shadow: 0 4px 10px rgba(185, 28, 128, 0.5);
        }

        .footer-soft {
            padding: 20px 0;
            background: var(--navbar-gradient); 
            color: var(--text-dark); 
            text-align: center;
            border-top: 1px solid rgba(0, 0, 0, 0.1); 
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1); 
            font-size: 0.9rem;
            margin-top: 50px;
        }
        
 
        h1, h2, h3, h4, h5, h6 {
            color: var(--text-dark);
            font-weight: 700;
        }
 
        .table {
            --bs-table-color: var(--text-dark);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                🌸 <span style="color:var(--text-dark);">Manajemen Produk</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            🏠 Home
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            📦 Produk
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            🏷️ Kategori
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('warehouses*') ? 'active' : '' }}" href="{{ route('warehouses.index') }}">
                            🏭 Gudang
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('stocks*') ? 'active' : '' }}" href="{{ route('stocks.index') }}">
                            📊 Stok
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <main class="py-4">
        @yield('content')
    </main>

    <footer class="footer-soft mt-auto">
        <div class="container">
            © 2025 Sistem Manajemen Produk. Dibuat oleh Vina Sucitra.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>