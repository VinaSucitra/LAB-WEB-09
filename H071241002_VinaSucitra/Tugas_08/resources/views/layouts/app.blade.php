<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fish It Simulator 🎣</title>

    {{-- Tailwind + Bootstrap Icons + Font --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="relative text-cyan-100 overflow-x-hidden min-h-screen bg-cover bg-center bg-no-repeat bg-fixed"
      style="background-image: url('{{ asset('images/ubur.jpg') }}')">

    {{-- Efek cahaya laut --}}
    <div class="fixed top-[-150px] left-[-100px] w-[350px] h-[350px] bg-[radial-gradient(circle,rgba(0,255,255,0.18)_0%,transparent_70%)] blur-[60px] animate-[float_12s_ease-in-out_infinite_alternate] z-0"></div>

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-[#003366] via-[#001f3f] to-[#002b80] shadow-[0_0_25px_rgba(0,150,255,0.3)] border-b border-cyan-500/20 backdrop-blur-md transition-all duration-300 p-5 px-8 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <i class="bi bi-fish text-3xl text-cyan-400 drop-shadow-[0_0_10px_rgba(0,200,255,0.6)]"></i>
            <h1 class="text-2xl font-extrabold bg-gradient-to-r from-cyan-400 via-cyan-300 to-blue-400 bg-clip-text text-transparent tracking-wide">Fish It Simulator</h1>
        </div>
    </nav>

    {{-- Konten utama --}}
    <div class="max-w-7xl mx-auto px-6 py-8 mt-28 relative z-10">
        @if(session('success'))
            <div class="mb-6 rounded-lg px-4 py-3 bg-cyan-700/70 text-white shadow-md">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    {{-- Animasi keyframes untuk cahaya laut --}}
    <style>
        @keyframes float {
            0% { transform: translate(0, 0); opacity: 0.4; }
            100% { transform: translate(120px, 180px); opacity: 0.7; }
        }
    </style>

</body>
</html>
