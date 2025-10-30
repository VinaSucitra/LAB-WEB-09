@extends('layouts.master')

@section('title', 'Beranda | Eksplor Raja Ampat')

@section('content')
<!-- 🌅 Hero Section -->
<section 
    class="relative bg-cover bg-center flex items-center justify-center text-center overflow-hidden"
    style="background-image: url('/images/rajaampat_home.jpg'); min-height: calc(100vh - 64px);">
    
    <!-- Overlay gradasi lembut sunset -->
    <div class="absolute inset-0 bg-gradient-to-b from-orange-400/70 via-pink-400/40 to-blue-600/60"></div>

    <!-- Teks Hero dengan animasi -->
    <div class="relative z-10 max-w-4xl mx-auto px-6 py-10 text-white">
        <h1 
            class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-lg 
                   opacity-0 translate-y-6 animate-fade-slide-up [animation-delay:200ms]">
            Selamat Datang di Surga Bawah Laut Raja Ampat 🌴
        </h1>
        <p 
            class="text-lg md:text-xl text-white/90 leading-relaxed mb-8 drop-shadow-md 
                   opacity-0 translate-y-6 animate-fade-slide-up [animation-delay:400ms]">
            Eksplor keindahan laut, pulau, dan budaya eksotis Raja Ampat yang memikat hati dan menenangkan jiwa.
            Raja Ampat adalah gugusan kepulauan yang terletak di ujung barat laut Papua, Indonesia, terkenal sebagai salah satu surga bahari terbaik di dunia. Kawasan ini terdiri dari lebih dari 1.500 pulau kecil, atol, dan pasir timbul yang mengelilingi empat pulau utama: Waigeo, Batanta, Salawati, dan Misool.
        </p>
        <a href="/destinasi" 
           class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105
                  opacity-0 translate-y-6 animate-fade-slide-up [animation-delay:600ms]">
           Jelajahi Sekarang
        </a>
    </div>
</section>

<!--  animasi custom Tailwind -->
<style>
@keyframes fade-slide-up {
  0% {
    opacity: 0;
    transform: translateY(24px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fade-slide-up {
  animation: fade-slide-up 1s ease-out forwards;
}
</style>
@endsection
