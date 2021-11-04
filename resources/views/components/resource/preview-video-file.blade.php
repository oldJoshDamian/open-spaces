@props(['resource', 'resourceful'])
<a class="block" href="{{ route('resource.view', ['resource' => $resource, 'type' => 'document']) }}">
    <div class="p-3 border-b border-gray-400">
        <div title="{{ $resource->title }}" class="font-semibold text-blue-700 truncate text-md">
            {{ $resource->title }}
        </div>
    </div>
    <div>
        <div class="p-3">
            <img class="object-cover mx-auto w-60 h-72 sm:h-40 sm:w-32" src="{{ $resourceful->poster_url }}" alt="{{ $resource->title }}" />
        </div>
        <div class="p-3 text-sm font-semibold text-blue-700 bg-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center flex-1 mr-4">
                    <i class="mr-2 text-lg fas fa-file-video"></i> Video file
                </div>
                <div class="flex-shrink-0 text-sm font-medium text-gray-700">
                    {{ $resourceful->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
</a>
