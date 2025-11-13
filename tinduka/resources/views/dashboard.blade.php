<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="text-base-content/80">Start exploring Kenya's best destinations.</p>
                <a href="{{ route('home') }}" class="btn btn-primary mt-4">Go to Home</a>
            </div>
        </div>
    </div>
</x-app-layout>