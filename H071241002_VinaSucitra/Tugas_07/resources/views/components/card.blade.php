<div class="bg-white rounded-2xl overflow-hidden shadow-md 
            transform transition-all duration-300 ease-out 
            hover:shadow-2xl hover:-translate-y-2 hover:scale-[1.02] 
            hover:bg-gradient-to-b hover:from-indigo-50 hover:to-white 
            hover:ring-2 hover:ring-indigo-200">

    <!-- Gambar -->
    <img src="{{ $image }}" 
         alt="{{ $title }}" 
         class="w-full h-56 object-cover rounded-t-2xl transition duration-300 hover:opacity-95">

    <!-- Isi Card -->
    <div class="p-5">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
            {{ $title }}
        </h3>
        <p class="text-gray-600 text-sm leading-relaxed">
            {{ $description }}
        </p>
    </div>
</div>
