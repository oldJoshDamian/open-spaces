<div>
    <div class="justify-end md:flex">
        <div class="relative">
            <div class="flex">
                <x-jet-input wire:model="query" type="search" name="open_search" class="w-full mr-3 bg-gray-100 md:w-96"
                    placeholder="search Open Spaces" />
                <x-jet-secondary-button wire:click="stopSuggestion" class="text-blue-700 bg-gray-100">
                    <i class="text-md fas fa-search"></i>
                </x-jet-secondary-button>
            </div>
            @if($shouldSuggest && $results->count() > 0)
            <div class="w-full mt-2 mb-4 md:overflow-y-auto md:max-h-96 md:z-50 md:absolute md:shadow-2xl">
                <div class="grid grid-cols-1 gap-1 bg-gray-300">
                    @foreach($results as $key=> $result)
                    @php
                    $modelName = strtolower(class_basename($result));
                    @endphp
                    @include('search-suggestion.'.$modelName, [$modelName => $result])
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    @if($showResults)
    <div class="px-4 mb-3 text-lg font-semibold text-gray-700 sm:px-0">
        Search results for "{{ $query }}"
    </div>
    <div class="grid grid-cols-1 gap-3 pb-10 mt-3 mb-3 md:grid-cols-2 lg:grid-cols-3">
        @foreach($results as $key => $result)
        @php
        $modelName = strtolower(class_basename($result));
        @endphp
        @include('search-result.'.$modelName, [$modelName => $result])
        @endforeach
    </div>
    @endif
</div>
