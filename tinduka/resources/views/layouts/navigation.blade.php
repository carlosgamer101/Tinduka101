<nav class="navbar bg-base-100 shadow-xl border-b border-base-300">
    <!-- LEFT: LOGO -->
    <div class="flex-none">
        <a href="{{ route('home') }}" class="btn btn-ghost text-xl normal-case flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Tinduka" class="w-8 h-8 rounded-full">
            <span class="hidden sm:inline">Tinduka</span>
        </a>
    </div>

    <!-- CENTER: NAV LINKS -->
    <div class="flex-1 justify-center hidden md:flex">
        <ul class="menu menu-horizontal px-1 gap-2">
            <li>
                <a href="{{ route('home') }}" class="btn btn-ghost btn-sm {{ request()->is('/') ? 'btn-active' : '' }}">
                    Home
                </a>
            </li>

            @auth
                <li>
                    <a href="{{ route('profile.edit') }}" class="btn btn-ghost btn-sm {{ request()->is('profile*') ? 'btn-active' : '' }}">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full ring ring-primary ring-offset-base-100 ring-offset-1">
                                <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/logo.png') }}" 
                                     class="w-full h-full object-cover rounded-full" />
                            </div>
                            <span>Profile</span>
                        </div>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-ghost btn-sm text-error">
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Login</a></li>
                <li><a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a></li>
            @endauth
        </ul>
    </div>

    <!-- RIGHT: SEARCH -->
    <div class="flex-none gap-2 items-center">
        <!-- Desktop Search -->
        <div class="hidden lg:block w-64">
            <livewire:location-search />
        </div>

        <!-- Mobile Search + Menu -->
        <div class="lg:hidden flex gap-2">
            <!-- Mobile Search Icon -->
            <label for="mobile-search" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </label>

            <!-- Mobile Menu (Hamburger) -->
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    @auth
                        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Search Modal -->
<input type="checkbox" id="mobile-search" class="modal-toggle" />
<div class="modal">
    <div class="modal-box p-4">
        <livewire:location-search />
        <div class="modal-action">
            <label for="mobile-search" class="btn btn-sm btn-circle">X</label>
        </div>
    </div>
</div>