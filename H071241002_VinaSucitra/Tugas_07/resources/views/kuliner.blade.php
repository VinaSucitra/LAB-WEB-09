@extends('layouts.master')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-extrabold mb-10 text-center text-gray-800 flex items-center justify-center gap-2">
            🍽️ Kuliner Khas Papua Barat
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Papeda -->
            <x-card 
                image="/images/papeda.jpg" 
                title="Papeda" 
                description="Makanan khas berbahan dasar sagu dengan tekstur kenyal, biasanya disajikan dengan kuah ikan kuning yang gurih."
            />

            <!-- Ikan Kuah Kuning -->
            <x-card 
                image="/images/ikan_kuah_kuning.jpg" 
                title="Ikan Kuah Kuning" 
                description="Ikan segar dimasak dengan kuah kunyit khas Papua, memberikan cita rasa asam gurih yang menyegarkan."
            />

            <!-- Sagu Lempeng -->
            <x-card 
                image="/images/sagu_lempeng.jpg" 
                title="Sagu Lempeng" 
                description="Kue kering tradisional berbahan sagu, renyah di luar namun lembut di dalam, cocok disantap dengan teh atau kopi."
            />

            <!-- Ikan Bakar Manokwari -->
            <x-card 
                image="/images/ikan_bakar_manokwari.jpg" 
                title="Ikan Bakar Manokwari" 
                description="Hidangan ikan bakar khas Manokwari dengan sambal rica pedas yang menggugah selera, menjadi ikon kuliner pesisir Papua."
            />

            <!-- Ulat Sagu -->
            <x-card 
                image="/images/ulat_sagu.jpg" 
                title="Ulat Sagu" 
                description="Makanan ekstrem yang kaya protein, biasanya dimakan langsung atau dibakar hingga garing — simbol keunikan kuliner tradisional Papua."
            />

            <!-- Sinole -->
            <x-card 
                image="/images/sinole.jpg" 
                title="Sinole" 
                description="Olahan sagu yang dimasak seperti pancake, sering dijadikan pengganti nasi di berbagai daerah Papua."
            />
        </div>
    </div>
</section>
@endsection
