<div class="relative mt-3 md:mt-0" x-data="{isOpen : true}" @click.away="isOpen = false">
    <input type="text"
        class="pl-8 bg-gray-800 rounded-full w-72 px-4 py-1 focus:outline-none focus:ring-2 focus:ring-purple-500  focus:border-transparent focus:w-96"
        placeholder="Search (Press '/' to focus)" wire:model.debounce.500ms="search" @focus="isOpen = true"
        x-ref="search" 
        @keydown.window="
            if(event.keyCode === 191){
                event.preventDefault(); 
                $refs.search.focus();
            }
        "
        >
    <div class="absolute top-0">
        <i class="fas fa-search fill-current text-gray-500 w-4 mt-2 ml-2"></i>
    </div>

    <div class="spinner right-0 top-0 mr-4 mt-4" wire:loading></div>

    <div class="absolute bg-gray-800 mt-3 rounded w-72 text-sm" x-show="isOpen" @keydown.escape.window="isOpen = false">
        <ul>
            @if (strlen($search) > 2)
                @forelse($searchResults as $result)
                    <a href="{{ route('movies.show', $result['id']) }}" @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                        <li class="border-b border-gray-700 px-3 py-3 hover:bg-gray-600">
                            <div class="flex  items-center">
                                <img @if ($result['poster_path'] == null)
                                src="https://via.placeholder.com/50x75"
                            @else src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}"
                @endif
                class="w-8" alt="{{ $result['title'] }}" />
                <span class="ml-3">{{ $result['title'] }}</span>
    </div>
    </li>
    </a>
@empty
    <li class="border-b border-gray-700 px-3 py-3 hover:bg-gray-600">
        No results for "{{ $search }}"
    </li>
    @endforelse
    @endif
    </ul>
</div>
</div>
