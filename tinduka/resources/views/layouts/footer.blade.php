<footer class="footer p-10 bg-base-300 text-base-content mt-auto border-t border-base-200">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Logo + Description -->
        <div class="flex flex-col items-center md:items-start">
            <img src="{{ asset('images/logo.png') }}" alt="Tinduka Logo" class="w-12 h-12 mb-3 rounded-full ring ring-primary ring-offset-2 ring-offset-base-300">
            <p class="font-bold text-lg">Tinduka</p>
            <p class="text-sm opacity-80 text-center md:text-left">Explore Kenya. Share Stories. Discover Magic.</p>
        </div>

        <!-- About -->
        <div class="flex flex-col items-center md:items-start">
            <span class="footer-title text-lg mb-2">About</span>
            <p class="text-sm opacity-80 text-center md:text-left max-w-xs">
                Tinduka is a community-driven platform to discover, review, and share Kenya's most beautiful destinations.
            </p>
        </div>

        <!-- Links -->
        <div class="flex flex-col items-center md:items-start">
            <span class="footer-title text-lg mb-2">Quick Links</span>
            <div class="flex flex-col gap-1 text-sm">
                <a href="{{ route('home') }}" class="link link-hover opacity-80">Home</a>
                @auth
                    <a href="{{ route('profile.edit') }}" class="link link-hover opacity-80">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="link link-hover opacity-80">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="link link-hover opacity-80">Login</a>
                    <a href="{{ route('register') }}" class="link link-hover opacity-80">Register</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center mt-8 pt-6 border-t border-base-200 text-sm opacity-60">
        © {{ date('Y') }} Tinduka. All rights reserved.
    </div>
</footer>