<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-base-content">My Reviews</h1>

        @if(auth()->user()->reviews->count())
            <div class="space-y-8">
                @foreach(auth()->user()->reviews as $review)
                    <div class="bg-base-100 rounded-2xl p-6 shadow-lg flex gap-4">
                        <!-- Location Image -->
                        <a href="{{ route('locations.show', $review->location) }}" class="flex-shrink-0">
                            <img src="{{ asset('images/' . $review->location->image) }}" 
                                 class="w-24 h-24 rounded-xl object-cover shadow" 
                                 alt="{{ $review->location->name }}">
                        </a>

                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <a href="{{ route('locations.show', $review->location) }}" 
                                   class="text-xl font-bold text-primary hover:underline">
                                    {{ $review->location->name }}
                                </a>
                                <span class="text-sm text-base-content/60">{{ $review->created_at->diffForHumans() }}</span>
                            </div>

                            <p class="text-base-content/90 mb-3">{{ $review->content }}</p>

                            @if($review->photo)
                                <img src="{{ asset('storage/' . $review->photo) }}" 
                                     class="w-full max-w-md rounded-lg shadow mb-3" />
                            @endif

                            <div class="flex gap-2">
                                <a href="{{ route('locations.show', $review->location) }}#review-{{ $review->id }}" 
                                   class="btn btn-sm btn-ghost">View</a>
                                <button onclick="openEditModal({{ $review->id }})" 
                                        class="btn btn-sm btn-ghost text-info">Edit</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>You haven't written any reviews yet. <a href="{{ route('home') }}" class="link">Explore destinations!</a></span>
            </div>
        @endif
    </div>
</x-app-layout>