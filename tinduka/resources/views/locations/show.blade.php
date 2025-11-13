<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $location->name }} - Travel Kenya</title>
    <!-- Include Tailwind CSS and DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.0/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-base-200">
    <!-- Navigation would be here in a real app -->
    
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Hero Section -->
        <div class="relative h-96 rounded-3xl overflow-hidden shadow-2xl mb-10 fade-in">
            <img src="{{ asset('images/' . $location->image) }}" alt="{{ $location->name }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-8 left-8 text-white">
                <h1 class="text-5xl md:text-6xl font-bold drop-shadow-lg">{{ $location->name }}</h1>
                <p class="text-2xl opacity-90">Kenya</p>
            </div>
        </div>

        <!-- Description Section -->
        <div class="bg-base-100 rounded-3xl p-8 shadow-xl mb-10 fade-in">
            <h2 class="text-3xl font-bold mb-6 text-base-content">About {{ $location->name }}</h2>
            <p class="text-lg leading-relaxed text-base-content/90">
                {{ $location->description }}
            </p>
        </div>

        <!-- Reviews Section -->
        <div class="bg-base-100 rounded-3xl p-8 shadow-xl fade-in">
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
                        <article class="border-b border-base-300 pb-8 last:border-0 fade-in" id="review-{{ $review->id }}">
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

                                        <!-- EDIT / DELETE BUTTONS -->
                                        @if($review->user_id === auth()->id())
                                            <div class="flex gap-2">
                                                <button onclick="openEditModal({{ $review->id }})" 
                                                        class="btn btn-ghost btn-xs text-info">Edit</button>
                                                
                                                <form method="POST" 
                                                      action="{{ route('reviews.delete', [$location, $review]) }}" 
                                                      onsubmit="return confirm('Are you sure you want to delete this review?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-ghost btn-xs text-error">Delete</button>
                                                </form>
                                            </div>
                                        @endif
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
                                                            <img src="{{ $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : asset('images/logo.png') }}" 
                                                                 alt="{{ $comment->user->name }}" />
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
                                  required>{{ old('content') }}</textarea>
                        
                        @error('content')
                            <div class="text-error text-sm">{{ $message }}</div>
                        @enderror
                        
                        <div>
                            <label class="label">
                                <span class="label-text text-base-content">Add a photo (optional)</span>
                            </label>
                            <input type="file" name="photo" class="file-input file-input-bordered file-input-primary w-full max-w-md" accept="image/*">
                            
                            @error('photo')
                                <div class="text-error text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-wide">Submit Review</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>

    <!-- EDIT MODALS -->
    @foreach($location->reviews as $review)
        @if($review->user_id === auth()->id())
            <dialog id="edit-modal-{{ $review->id }}" class="modal">
                <div class="modal-box">
                    <h3 class="text-xl font-bold mb-4 text-base-content">Edit Review</h3>
                    <form method="POST" action="{{ route('reviews.update', [$location, $review]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <textarea name="content" rows="4" class="textarea textarea-bordered w-full bg-base-200 text-base-content" required>{{ old('content', $review->content) }}</textarea>
                        
                        @error('content')
                            <div class="text-error text-sm">{{ $message }}</div>
                        @enderror
                        
                        <input type="file" name="photo" class="file-input file-input-bordered w-full mt-2" accept="image/*">
                        
                        @error('photo')
                            <div class="text-error text-sm">{{ $message }}</div>
                        @enderror
                        
                        @if($review->photo)
                            <p class="text-sm text-base-content/60 mt-1">Current photo: <a href="{{ asset('storage/' . $review->photo) }}" target="_blank" class="link">view</a></p>
                        @endif
                        
                        <div class="modal-action">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" onclick="closeEditModal({{ $review->id }})" class="btn">Cancel</button>
                        </div>
                    </form>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>
        @endif
    @endforeach

    <!-- Success/Error Toast Notification -->
    <div id="toast" class="toast toast-top toast-end hidden">
        <div class="alert alert-success" id="toast-content">
            <span id="toast-message">Operation completed successfully.</span>
        </div>
    </div>

    <script>
        // Modal functions
        function openEditModal(id) {
            document.getElementById(`edit-modal-${id}`).showModal();
        }
        
        function closeEditModal(id) {
            document.getElementById(`edit-modal-${id}`).close();
        }

        // Toast notification function
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastContent = document.getElementById('toast-content');
            const toastMessage = document.getElementById('toast-message');
            
            // Set message and type
            toastMessage.textContent = message;
            toastContent.className = `alert alert-${type}`;
            
            // Show toast
            toast.classList.remove('hidden');
            
            // Hide after 3 seconds
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        // Show toast if there are success messages
        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif

        // Show toast if there are error messages
        @if(session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif

        // Smooth scroll to review form
        function scrollToReviewForm() {
            document.getElementById('review-form').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Handle form submissions with AJAX for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add AJAX handling for comment forms
            const commentForms = document.querySelectorAll('form[action*="comment"]');
            commentForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const url = this.getAttribute('action');
                    
                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Refresh the page to show the new comment
                            location.reload();
                        } else {
                            showToast('Failed to post comment', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Failed to post comment', 'error');
                    });
                });
            });
        });
    </script>
</body>
</html>