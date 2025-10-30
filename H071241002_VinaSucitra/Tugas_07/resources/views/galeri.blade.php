@extends('layouts.master')

@section('content')
<section class="py-16 bg-gradient-to-b from-orange-50 via-pink-50 to-blue-50">
    <div class="container mx-auto px-6">
        <!-- Judul Galeri -->
        <h2 class="text-2xl md:text-3xl font-extrabold text-center mb-12 text-gray-800">
            🌴 Galeri Keindahan <span class="text-pink-600">Raja Ampat</span>
        </h2>

        <!-- Grid Galeri -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            
            @php
                $galeri = [
                    ['img' => '/images/wayag.jpg', 'judul' => 'Kepulauan Wayag', 'desk' => 'Ikon Raja Ampat dengan pemandangan karst menakjubkan'],
                    ['img' => '/images/pasir_timbul.jpg', 'judul' => 'Pantai Pasir Timbul', 'desk' => 'Pulau pasir kecil yang muncul saat air laut surut'],
                    ['img' => '/images/bawah_laut.jpg', 'judul' => 'Surga Bawah Laut', 'desk' => 'Terumbu karang Raja Ampat yang memukau mata'],
                    ['img' => '/images/arborek.jpg', 'judul' => 'Desa Arborek', 'desk' => 'Desa wisata bahari terkenal dengan kehidupan lautnya'],
                    ['img' => '/images/kri.jpg', 'judul' => 'Pulau Kri', 'desk' => 'Surga menyelam dengan terumbu karang berwarna-warni'],
                    ['img' => '/images/manta.png', 'judul' => 'Manta Point', 'desk' => 'Tempat terbaik melihat pari manta raksasa'],
                    ['img' => '/images/fam.png', 'judul' => 'Pulau Fam', 'desk' => 'Pulau eksotis dengan pantai putih dan air jernih'],
                    ['img' => '/images/sunset.jpg', 'judul' => 'Sunset Raja Ampat', 'desk' => 'Matahari terbenam yang menenangkan jiwa'],
                ];
            @endphp

            @foreach ($galeri as $item)
                <!-- Kartu Galeri -->
                <div class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-white">
                    <img src="{{ $item['img'] }}" alt="{{ $item['judul'] }}" class="w-full h-60 object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <!-- Overlay Transparan -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Teks Overlay -->
                    <div class="absolute bottom-0 p-5 text-white opacity-0 group-hover:opacity-100 transition duration-500">
                        <h3 class="text-xl font-bold drop-shadow-md">{{ $item['judul'] }}</h3>
                        <p class="text-sm opacity-90">{{ $item['desk'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
