@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white to-pink-50 py-16">
    <div class="max-w-2xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-pink-600 mb-10" data-aos="fade-down">
            Kontak Kami
        </h2>

        <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-lg p-8 border border-pink-100" data-aos="fade-up">
            <form class="space-y-6">
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">Nama:</label>
                    <input type="text" placeholder="Masukkan nama Anda"
                           class="w-full border border-pink-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-300 p-3 rounded-xl outline-none transition-all duration-300">
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">Email:</label>
                    <input type="email" placeholder="Masukkan email Anda"
                           class="w-full border border-pink-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-300 p-3 rounded-xl outline-none transition-all duration-300">
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">Pesan:</label>
                    <textarea rows="4" placeholder="Tulis pesan Anda di sini..."
                              class="w-full border border-pink-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-300 p-3 rounded-xl outline-none transition-all duration-300 resize-none"></textarea>
                </div>

                <div class="text-center pt-2">
                    <button type="submit"
                            class="bg-gradient-to-r from-pink-500 to-orange-400 text-white font-semibold px-8 py-3 rounded-xl shadow-md hover:shadow-lg hover:from-pink-600 hover:to-orange-500 transition-all duration-300">
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
