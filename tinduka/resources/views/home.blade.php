<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Hero -->
        <section class="hero min-h-96 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-3xl p-12 mb-16 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">
                    Discover Kenya's Hidden Gems
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">
                    Explore, review, and share the most breathtaking destinations.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Join Tinduka</a>
                    <a href="#destinations" class="btn btn-ghost btn-lg">Explore Now</a>
                </div>
            </div>
        </section>

        <!-- Grid -->
        <section id="destinations">
            <h2 class="text-4xl font-bold text-center mb-12">Featured Destinations</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach(\App\Models\Location::all() as $location)
                    <a href="{{ route('locations.show', $location) }}" class="group block transform transition-all duration-300 hover:scale-105">
                        <div class="card bg-base-100 shadow-xl h-full overflow-hidden">
                            <figure class="h-56 relative overflow-hidden">
                                <img 
                                    src="{{ asset('images/' . $location->image) }}" 
                                    alt="{{ $location->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </figure>
                            <div class="card-body p-6">
                                <h3 class="card-title text-xl group-hover:text-primary transition-colors">
                                    {{ $location->name }}
                                </h3>
                                <p class="text-sm text-base-content/70 line-clamp-2">
                                    {{ Str::limit($location->description, 100) }}
                                </p>
                                <div class="card-actions justify-end mt-4">
                                    <div class="badge badge-primary badge-outline">Explore</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>