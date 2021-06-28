@can('view', $space)
<div class="bg-white shadow-md md:rounded-md">
    <a href="{{ route('space.show', ['space' => $space]) }}">
        <div class="flex flex-row items-center p-4 border-b border-gray-300">
            <div class="flex-shrink-0 mr-3">
                <img class="object-cover w-16 h-16 rounded-full md:w-24 md:h-24" src="{{ $space->profile_photo_url }}"
                    alt="{{ $space->name }}" />
            </div>
            <div>
                <div class="text-xl font-semibold text-gray-800 break-long-words">
                    {{ $space->name }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                    {{ $space->visibility }} space
                </div>
            </div>
        </div>
        <div class="p-4 text-gray-700 text-md">
            {{ $space->description ?? __('no description available') }}
        </div>
    </a>
</div>
@endcan
