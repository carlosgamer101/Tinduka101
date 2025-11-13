<div>
    <input 
        type="text" 
        wire:model.live.debounce.300ms="search" 
        placeholder="Search destinations..." 
        class="input input-bordered input-primary w-full bg-base-100 text-base-content placeholder:text-base-content/70 focus:outline-none focus:ring-2 focus:ring-primary"
    >

    @if($search && $locations->count())
        <div class="absolute mt-1 w-full bg-base-100 rounded-box shadow-2xl z-50 border border-base-300 overflow-hidden">
            <ul class="menu p-0">
                @foreach($locations as $location)
                    <li>
                        <a href="{{ route('locations.show', $location) }}" class="flex items-center gap-3 p-3 hover:bg-base-200 transition">
                            <div class="w-12 h-12 rounded-lg overflow-hidden border border-base-300">
                                <img src="{{ asset('images/' . $location->image) }}" class="w-full h-full object-cover" alt="{{ $location->name }}" />
                            </div>
                            <div>
                                <div class="font-bold text-base-content">{{ $location->name }}</div>
                                <div class="text-xs text-base-content/60">Kenya • National Park</div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @elseif($search)
        <div class="absolute mt-1 w-full bg-base-100 rounded-box shadow-2xl p-4 text-center text-base-content/70">
            No locations found.
        </div>
    @endif
</div>