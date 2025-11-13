<!DOCTYPE html>
<html lang="en" class="h-full" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tinduka</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full bg-cover bg-center bg-no-repeat flex items-center justify-center p-4" 
      style="background-image: url('{{ asset('images/auth/bg.jpg') }}');">

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Tinduka" class="w-16 h-16 rounded-full ring-4 ring-primary/50 shadow-2xl">
                <span class="text-4xl font-bold text-white drop-shadow-lg">Tinduka</span>
            </a>
        </div>

        <!-- Glass Card -->
        <div class="backdrop-blur-xl bg-black/60 rounded-3xl shadow-2xl p-8 border border-white/10">
            <h2 class="text-3xl font-bold text-center text-white mb-2">Join Tinduka</h2>
            <p class="text-center text-white/70 mb-8">Start exploring Kenya today</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="label">
                        <span class="label-text text-white font-medium">Full Name</span>
                    </label>
                    <input name="name" type="text" required 
                           class="input input-bordered w-full bg-white/10 border-white/20 text-white placeholder:text-white/50 @error('name') input-error @enderror"
                           value="{{ old('name') }}" placeholder="John Doe">
                    @error('name')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="label">
                        <span class="label-text text-white font-medium">Email</span>
                    </label>
                    <input name="email" type="email" required 
                           class="input input-bordered w-full bg-white/10 border-white/20 text-white placeholder:text-white/50 @error('email') input-error @enderror"
                           value="{{ old('email') }}" placeholder="you@example.com">
                    @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="label">
                        <span class="label-text text-white font-medium">Password</span>
                    </label>
                    <input name="password" type="password" required 
                           class="input input-bordered w-full bg-white/10 border-white/20 text-white placeholder:text-white/50 @error('password') input-error @enderror"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="label">
                        <span class="label-text text-white font-medium">Confirm Password</span>
                    </label>
                    <input name="password_confirmation" type="password" required 
                           class="input input-bordered w-full bg-white/10 border-white/20 text-white placeholder:text-white/50"
                           placeholder="••••••••">
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-full btn-lg">
                    Create Account
                </button>
            </form>

            <p class="text-center text-white/70 mt-6 text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="link link-primary font-medium">Sign in</a>
            </p>
        </div>
    </div>

    @livewireScripts
</body>
</html>