<x-app-layout>
    <div class="max-w-2xl mx-auto py-12">
        <div class="bg-base-100 rounded-3xl shadow-xl p-8">
            <h1 class="text-3xl font-bold mb-8 text-base-content">My Account</h1>

            @if(session('success'))
                <div class="alert alert-success shadow-lg mb-6">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- TABS -->
            <div class="tabs tabs-boxed mb-8">
                <a href="{{ route('profile.edit') }}" 
                   class="tab {{ request()->is('profile') && !request()->is('profile/reviews') ? 'tab-active' : '' }}">
                    Edit Profile
                </a>
                <a href="{{ route('profile.reviews') }}" 
                   class="tab {{ request()->is('profile/reviews') ? 'tab-active' : '' }}">
                    My Reviews ({{ auth()->user()->reviews->count() }})
                </a>
            </div>

            <!-- ONLY SHOW FORM ON EDIT TAB -->
            @if(!request()->is('profile/reviews'))
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('patch')

                    <!-- Avatar -->
                    <div class="flex items-center gap-6 mb-8">
                        <div class="avatar">
                            <div class="w-24 h-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-4">
                                <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/logo.png') }}" 
                                     alt="Profile" class="object-cover" />
                            </div>
                        </div>
                        <div>
                            <label class="block">
                                <input type="file" name="profile_photo" class="file-input file-input-bordered file-input-primary w-full max-w-xs" accept="image/*">
                            </label>
                            <p class="text-sm text-base-content/60 mt-1">JPG, PNG up to 5MB</p>
                        </div>
                    </div>

                    <!-- Name -->
                    <div>
                        <label class="label">
                            <span class="label-text text-base-content font-medium">Name</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" 
                               class="input input-bordered w-full bg-base-200 text-base-content" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="label">
                            <span class="label-text text-base-content font-medium">Email</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                               class="input input-bordered w-full bg-base-200 text-base-content" required>
                    </div>

                    <!-- Submit -->
                    <div class="flex gap-3">
                        <button type="submit" class="btn btn-primary flex-1">Save Changes</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-ghost flex-1">Cancel</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>