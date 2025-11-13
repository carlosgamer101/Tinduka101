<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Hero -->
        <div class="relative h-96 rounded-3xl overflow-hidden shadow-2xl mb-10">
            <img src="{{ asset('images/' . $location->image) }}" alt="{{ $location->name }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-8 left-8 text-white">
                <h1 class="text-5xl md:text-6xl font-bold drop-shadow-lg">{{ $location->name }}</h1>
                <p class="text-2xl opacity-90">Kenya</p>
            </div>
        </div>

        <!-- Description -->
        <div class="bg-base-100 rounded-3xl p-8 shadow-xl mb-10">
            <h2 class="text-3xl font-bold mb-6">About {{ $location->name }}</h2>
            <p class="text-lg leading-relaxed text-base-content/80">
                {{ $location->description }}
            </p>
        </div>

        <!-- Reviews -->
        <div class="bg-base-100 rounded-3xl p-8 shadow-xl">
            <h2 class="text-3xl font-bold mb-6">Reviews</h2>
            <div class="alert alert-info">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Reviews coming soon!</span>
            </div>
        </div>
    </div>
</x-app-layout>