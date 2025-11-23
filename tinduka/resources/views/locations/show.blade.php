<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $location->name }} - Tinduka</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn 0.6s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen">

<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Hero -->
    <div class="relative h-96 rounded-3xl overflow-hidden shadow-2xl mb-10 fade-in">
        <img src="{{ asset('images/' . $location->image) }}" alt="{{ $location->name }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
        <div class="absolute bottom-8 left-8">
            <h1 class="text-5xl md:text-7xl font-bold drop-shadow-2xl">{{ $location->name }}</h1>
            <p class="text-3xl opacity-90">Kenya</p>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-gray-800 rounded-3xl p-10 shadow-2xl mb-10 fade-in">
        <h2 class="text-4xl font-bold mb-6 text-purple-400">About This Gem</h2>
        <p class="text-xl leading-relaxed text-gray-300">{{ $location->description }}</p>
    </div>

    <!-- Reviews Section -->
    <div class="bg-gray-800 rounded-3xl p-10 shadow-2xl fade-in">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-4xl font-bold text-purple-400">Reviews ({{ $location->reviews->count() }})</h2>
            @auth
                <a href="#write-review" class="btn btn-primary btn-lg">Write Review</a>
            @endauth
        </div>

        <!-- Reviews List -->
        @forelse($location->reviews as $review)
            <div class="border-b border-gray-700 pb-8 mb-8 last:border-0">
                <div class="flex gap-5">
                    <img src="{{ $review->user->profile_photo ? asset('storage/' . $review->user->profile_photo) : asset('images/logo.png') }}"
                         class="w-16 h-16 rounded-full ring-4 ring-purple-600 object-cover">

                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-2xl font-bold text-purple-300">{{ $review->user->name }}</h4>
                                <p class="text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                            </div>

                            @if($review->user_id === auth()->id())
                                <div class="flex gap-2">
                                    <button onclick="document.getElementById('edit-{{ $review->id }}').showModal()"
                                            class="btn btn-ghost btn-sm text-cyan-400">Edit</button>
                                    <form action="{{ route('reviews.delete', [$location, $review]) }}" method="POST"
                                          onsubmit="return confirm('Delete this review?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-ghost btn-sm text-red-400">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <p class="text-lg text-gray-200 mt-3 leading-relaxed">{{ $review->content }}</p>

                        @if($review->photo)
                            <img src="{{ asset('storage/' . $review->photo) }}" class="mt-4 rounded-xl max-w-2xl shadow-xl">
                        @endif

                        <!-- COMMENTS -->
                        <div class="mt-6 space-y-4">
                            @foreach($review->comments->sortByDesc('created_at') as $comment)
                                <div class="flex gap-3 bg-gray-700/50 rounded-xl p-4">
                                    <img src="{{ $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : asset('images/logo.png') }}"
                                         class="w-10 h-10 rounded-full">
                                    <div>
                                        <p class="font-bold text-purple-300">{{ $comment->user->name }}</p>
                                        <p class="text-gray-300">{{ $comment->content }}</p>
                                        <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- ADD COMMENT FORM (NO AJAX = NO BUGS) -->
                        @auth
                            <form method="POST" action="{{ route('reviews.comment', $review) }}" class="mt-5 flex gap-3">
                                @csrf
                                <input type="text" name="content" required placeholder="Add a comment..."
                                       class="input input-bordered flex-1 bg-gray-700 text-white placeholder-gray-400">
                                <button type="submit" class="btn btn-primary">Post</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            @if($review->user_id === auth()->id())
                <dialog id="edit-{{ $review->id }}" class="modal">
                    <div class="modal-box bg-gray-800">
                        <h3 class="text-2xl font-bold mb-4">Edit Review</h3>
                        <form method="POST" action="{{ route('reviews.update', [$location, $review]) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <textarea name="content" rows="4" class="textarea textarea-bordered w-full bg-gray-700 text-white" required>{{ $review->content }}</textarea>
                            <input type="file" name="photo" class="file-input file-input-bordered mt-4 w-full" accept="image/*">
                            <div class="modal-action">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn" onclick="document.getElementById('edit-{{ $review->id }}').close()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </dialog>
            @endif
        @empty
            <div class="text-center py-16">
                <p class="text-2xl text-gray-500">No reviews yet. Be the first to share your experience!</p>
            </div>
        @endforelse

        <!-- WRITE REVIEW FORM -->
        @auth
            <div id="write-review" class="mt-16 border-t-2 border-purple-600 pt-10">
                <h3 class="text-3xl font-bold mb-8 text-purple-400">Write Your Review</h3>
                <form method="POST" action="{{ route('locations.review', $location) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <textarea name="content" rows="6" class="textarea textarea-bordered textarea-lg w-full bg-gray-700 text-white placeholder-gray-400" 
                              placeholder="Share your experience at {{ $location->name }}..." required></textarea>
                    
                    <input type="file" name="photo" class="file-input file-input-bordered file-input-primary w-full max-w-md" accept="image/*">
                    
                    <button type="submit" class="btn btn-primary btn-lg px-12">Submit Review</button>
                </form>
            </div>
        @endauth
    </div>
</div>

<!-- Success Toast -->
@if(session('success'))
    <div class="toast toast-top toast-center">
        <div class="alert alert-success shadow-lg">
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

</body>
</html>