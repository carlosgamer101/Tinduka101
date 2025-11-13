<nav class="navbar bg-base-100 shadow-xl border-b border-base-300">
    <div class="flex-1">
        <a href="{{ route('home') }}" class="btn btn-ghost text-xl normal-case flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Tinduka" class="w-8 h-8 rounded-full">
            <span class="hidden sm:inline">Tinduka</span>
        </a>
    </div>

    <div class="flex-none gap-4 items-center">
        <!-- Search (Desktop) -->
        <div class="hidden md:block w-64">
            <livewire:location-search />
        </div>

        <!-- Mobile Search -->
        <div class="md:hidden">
            <label for="mobile-search" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </label>
        </div>

        <!-- User Dropdown -->
        @auth
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/logo.png') }}" alt="User" />
                </div>
            </label>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a href="{{ route('profile.edit') }}" class="justify-between">
                        Profile
                        <span class="badge badge-sm">Edit</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @else
        <div class="flex gap-2">
            <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
        </div>
        @endauth
    </div>
</nav>

<!-- Mobile Search Modal -->
<input type="checkbox" id="mobile-search" class="modal-toggle" />
<div class="modal">
    <div class="modal-box p-4">
        <livewire:location-search />
        <div class="modal-action">
            <label for="mobile-search" class="btn btn-sm btn-circle">✕</label>
        </div>
    </div>
</div>