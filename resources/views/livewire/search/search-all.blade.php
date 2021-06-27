<div>
    <div class="justify-end px-4 sm:px-0 mb-6 md:mb-2 sm:flex">
        <div>
            <div class="flex">
                <x-jet-input wire:model="query" wire:change="search" type="search"
                    class="w-full mr-3 bg-gray-100 sm:w-96" placeholder="search for spaces, concepts, topics and resources" />
                <x-jet-secondary-button wire:click="stopSuggestion" class="text-blue-700 bg-gray-100">
                    <i class="text-md fas fa-search"></i>
                </x-jet-secondary-button>
            </div>
            @if($shouldSuggest)
            <div class="z-50 grid-cols-1 gap-1 mt-4 bg-gray-100">
                @foreach ($results as $result)
                <div class="p-3 bg-white"></div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    @if($showResults)
    <div class="grid grid-cols-1 gap-2 mb-5 bg-gray-100">
        @foreach($results as $key => $result)
        @switch($result::class)
        @case('App\Models\Space')
        <div class="p-3 bg-white">
            {{ $result->name }}
        </div>
        @break
        @default
        <div class="p-3 bg-white">
            {{ $result::class }}
        </div>
        @break
        @endswitch
        @endforeach
    </div>
    @endif
</div>