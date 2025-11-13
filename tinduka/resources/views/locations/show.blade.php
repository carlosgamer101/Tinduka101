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
            <h2 class="text-3xl font-bold mb-6 text-base-content">About {{ $location->name }}</h2>
            <p class="text-lg leading-relaxed text-base-content/90">
                {{ $location->description }}
            </p>
        </div>

        <!-- Reviews -->
        <div class="bg-base-100 rounded-3xl p-8 shadow-xl">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-base-content">Reviews ({{ $location->reviews->count() }})</h2>
                @auth
                    <button class="btn btn-primary" onclick="document.getElementById('review-form').scrollIntoView({behavior: 'smooth'})">
                        Write Review
                    </button>
                @endauth
            </div>

            @if($location->reviews->count())
                <div class="space-y-10">
                    @foreach($location->reviews as $review)
                        <article class="border-b border-base-300 pb-8 last:border-0">
                            <div class="flex gap-5">
                                <!-- Avatar -->
                                <div class="avatar">
                                    <div class="w-14 h-14 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <img src="{{ $review->user->profile_photo ? asset('storage/' . $review->user->profile_photo) : asset('images/logo.png') }}" 
                                             alt="{{ $review->user->name }}" 
                                             class="object-cover" />
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="text-xl font-bold text-base-content">{{ $review->user->name }}</h4>
                                            <p class="text-sm text-base-content/60">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>

                                    <p class="text-base text-base-content/90 leading-relaxed mb-4">
                                        {{ $review->content }}
                                    </p>

                                    <!-- Photo -->
                                    @if($review->photo)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/' . $review->photo) }}" 
                                                 class="w-full max-w-2xl rounded-xl shadow-lg object-cover" 
                                                 alt="Review photo" />
                                        </div>
                                    @endif

                                    <!-- Comments -->
                                    @if($review->comments->count())
                                        <div class="mt-6 space-y-4 pl-6 border-l-2 border-primary">
                                            @foreach($review->comments as $comment)
                                                <div class="flex gap-3">
                                                    <div class="avatar">
                                                        <div class="w-10 h-10 rounded-full">
                                                            <img src="{{ $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : asset('images/logo.png') }}" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-base-content">{{ $comment->user->name }}</p>
                                                        <p class="text-sm text-base-content/80">{{ $comment->content }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Add Comment -->
                                    @auth
                                        <form method="POST" action="{{ route('reviews.comment', $review) }}" class="mt-5 flex gap-2">
                                            @csrf
                                            <input type="text" 
                                                   name="content" 
                                                   class="input input-bordered input-sm flex-1 bg-base-200 text-base-content placeholder:text-base-content/60" 
                                                   placeholder="Add a comment..." 
                                                   required>
                                            <button type="submit" class="btn btn-sm btn-primary">Post</button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>No reviews yet. Be the first to share your experience!</span>
                </div>
            @endif

            <!-- Review Form -->
            @auth
                <div id="review-form" class="mt-12 border-t pt-8">
                    <h3 class="text-2xl font-bold mb-6 text-base-content">Write Your Review</h3>
                    <form method="POST" action="{{ route('locations.review', $location) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <textarea name="content" 
                                  rows="5" 
                                  class="textarea textarea-bordered textarea-lg w-full bg-base-200 text-base-content placeholder:text-base-content/60" 
                                  placeholder="Share your experience at {{ $location->name }}..." 
                                  required></textarea>
                        
                        <div>
                            <label class="label">
                                <span class="label-text text-base-content">Add a photo (optional)</span>
                            </label>
                            <input type="file" name="photo" class="file-input file-input-bordered file-input-primary w-full max-w-md" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary btn-wide">Submit Review</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>