@extends('layouts.master')

@section('content')
<!-- Judul Halaman -->
<div class="text-center mt-10 mb-12">
    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
        🌺 Adat Istiadat Papua Barat
    </h1>
    <p class="mt-3 text-gray-600 text-lg max-w-2xl mx-auto">
        Tradisi, nilai, dan budaya yang diwariskan dari generasi ke generasi — simbol keharmonisan antara manusia dan alam.
    </p>
</div>

<!-- Grid Adat Istiadat -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-8 lg:px-20">
    <x-card 
        image="/images/upacara_wedding.jpg"
        title="Upacara Pernikahan Adat"
        description="Prosesi pernikahan adat Papua Barat berlangsung dengan simbol-simbol penuh makna, melibatkan keluarga besar dan masyarakat sebagai bentuk penghormatan terhadap leluhur."
    />

    <x-card 
        image="/images/tari_perang.jpg"
        title="Tari Perang"
        description="Tarian tradisional yang menggambarkan semangat keberanian dan solidaritas antar suku. Diiringi tabuhan tifa yang membangkitkan energi dan kebanggaan masyarakat Papua."
    />

    <x-card 
        image="/images/pakaian_adat.jpg"
        title="Pakaian Adat Papua Barat"
        description="Dibuat dari bahan alami seperti akar, daun, dan bulu burung cenderawasih. Setiap hiasan melambangkan kekuatan, keindahan, dan hubungan manusia dengan alam."
    />

    <x-card 
        image="/images/bakar_batu.jpg"
        title="Upacara Bakar Batu"
        description="Ritual penting untuk mempererat kebersamaan antarwarga. Daging dan umbi dimasak bersama batu panas — simbol rasa syukur, persaudaraan, dan gotong royong."
    />

    <x-card 
        image="/images/honai.jpg"
        title="Rumah Adat Honai"
        description="Bangunan khas masyarakat pegunungan Papua yang terbuat dari kayu dan jerami. Melambangkan kehangatan, kesatuan, dan perlindungan keluarga."
    />

    <x-card 
        image="/images/tifa.png"
        title="Tifa - Alat Musik Tradisional"
        description="Tifa adalah alat musik pukul dari kulit rusa dan kayu pilihan. Suaranya khas dan menjadi pengiring utama dalam tarian serta upacara adat Papua Barat."
    />
</div>

<!-- Penjelasan Nilai dan Makna -->
<div class="mt-20 mx-8 lg:mx-20 bg-indigo-50 border border-indigo-100 rounded-2xl shadow-md p-10 transition-all duration-300 hover:shadow-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">
        💠 Nilai dan Makna Adat Papua Barat
    </h2>
    <p class="text-gray-700 leading-relaxed mb-4">
        Adat istiadat di Papua Barat mencerminkan keseimbangan antara manusia, alam, dan roh leluhur. 
        Setiap prosesi dan simbol adat memiliki nilai luhur seperti kebersamaan, rasa syukur, dan penghormatan terhadap kehidupan.
    </p>
    <p class="text-gray-700 leading-relaxed">
        Melalui tradisi seperti upacara bakar batu, tarian perang, hingga permainan tifa, masyarakat Papua Barat menjaga jati diri dan warisan budaya mereka agar tetap hidup di tengah arus modernisasi. 
        Nilai-nilai harmoni dan gotong royong menjadi dasar kehidupan sosial yang diwariskan dari masa ke masa.
    </p>
</div>
@endsection
