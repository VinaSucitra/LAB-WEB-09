<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eksplor Raja Ampat')</title>
    <script src="https://cdn.tailwindcss.com?plugins=typography,forms,aspect-ratio,line-clamp"></script>
    <style>
        .bg-soft-sunset {
            background: linear-gradient(to right, #FFD580, #FF9A8B, #A2C2E3);
        }
    </style>
</head>
<body class="font-sans text-gray-800 min-h-screen flex flex-col">

    <!-- 🌴 Navbar -->
    <header class="bg-soft-sunset shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">

            <!-- Logo -->
            <h1 class="text-2xl font-extrabold text-white flex items-center gap-2 drop-shadow-md">
                🌴 Eksplor Raja Ampat
            </h1>

            <!-- Tombol Burger (Mobile) -->
            <button 
                id="menu-btn" 
                class="md:hidden text-white focus:outline-none"
                aria-label="Toggle Menu">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Menu Desktop -->
            <nav class="hidden md:flex gap-6 text-white font-medium">
                <a href="{{ route('home') }}" class="hover:text-yellow-200 transition">Home</a>
                <a href="{{ route('destinasi') }}" class="hover:text-yellow-200 transition">Destinasi</a>
                <a href="{{ route('kuliner') }}" class="hover:text-yellow-200 transition">Kuliner</a>
                <a href="{{ route('adat') }}" class="hover:text-yellow-200 transition">Adat Istiadat</a>
                <a href="{{ route('galeri') }}" class="hover:text-yellow-200 transition">Galeri</a> 
                <a href="{{ route('kontak') }}" class="hover:text-yellow-200 transition">Kontak</a>
            </nav>
        </div>

        <!-- Menu Mobile -->
        <nav 
            id="mobile-menu" 
            class="hidden md:hidden bg-soft-sunset text-white font-medium text-center space-y-2 py-3">
            <a href="{{ route('home') }}" class="block py-2 hover:bg-white/20 rounded">Home</a>
            <a href="{{ route('destinasi') }}" class="block py-2 hover:bg-white/20 rounded">Destinasi</a>
            <a href="{{ route('kuliner') }}" class="block py-2 hover:bg-white/20 rounded">Kuliner</a>
            <a href="{{ route('adat') }}" class="block py-2 hover:bg-white/20 rounded">Adat Istiadat</a> 
            <a href="{{ route('galeri') }}" class="block py-2 hover:bg-white/20 rounded">Galeri</a>
            <a href="{{ route('kontak') }}" class="block py-2 hover:bg-white/20 rounded">Kontak</a>
        </nav>
    </header>

    <!-- 🌅 Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 🌴 Footer -->
    <footer class="bg-soft-sunset text-center text-white py-4 mt-0">
        <p class="font-semibold">
            © 2025 Eksplor Raja Ampat | Surga Tropis Nusantara 🌺
        </p>
    </footer>

    <!-- 🔹 Script Toggle Menu -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
