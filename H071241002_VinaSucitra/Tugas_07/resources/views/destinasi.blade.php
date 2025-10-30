@extends('layouts.master')

@section('title', 'Destinasi Raja Ampat')

@section('content')
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-10">
        Destinasi Unggulan di Raja Ampat 🌴
    </h2>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Pulau Wayag -->
        <x-card 
            title="Pulau Wayag" 
            image="/images/wayag.jpg"
            description="Pulau Wayag adalah ikon Raja Ampat yang memukau dengan gugusan pulau karst besar berwarna hijau, dikelilingi laut biru jernih bak kristal. Dari puncak bukitnya, kamu bisa melihat panorama laut luas dengan gradasi warna turquoise yang menakjubkan. Tempat ini menjadi simbol keindahan Raja Ampat yang dikenal hingga mancanegara. 🌊">
        </x-card>

        <!-- Piaynemo -->
        <x-card 
            title="Piaynemo" 
            image="/images/piaynemo.jpg"
            description="Disebut sebagai 'Wayag Mini', Piaynemo menawarkan panorama serupa namun lebih mudah dijangkau. Dari menara pandang yang terbuat dari kayu, kamu bisa menyaksikan gugusan pulau karst kecil berpadu dengan laut berwarna toska yang menenangkan. Piaynemo adalah destinasi sempurna untuk menikmati matahari terbenam yang hangat di ufuk barat. 🌅">
        </x-card>

        <!-- Teluk Kabui -->
        <x-card 
            title="Teluk Kabui" 
            image="/images/kabui.jpg"
            description="Teluk Kabui mempesona dengan tebing kapur menjulang dan air laut sebening kaca. Di antara tebing-tebingnya, terdapat gua-gua laut dan batu karang eksotis yang menjadi rumah bagi beragam ikan tropis. Area ini sangat direkomendasikan bagi pencinta snorkeling dan fotografi alam. 🐠">
        </x-card>
    </div>
</section>


@endsection
