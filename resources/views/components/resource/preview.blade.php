@props(['resource'])
@php
$resourceful = $resource->resourceful;
@endphp
@if($resourceful)
<div class="bg-gray-100">
    @switch($resourceful::class)
    @case('App\Models\Document')
    <a class="block" href="{{ route('resource.view', ['resource' => $resource, 'type' => 'document']) }}">
        <div class="p-3 border-b border-gray-400">
            <div title="{{ $resource->title }}" class="font-semibold text-blue-700 text-md truncate">
                {{ $resource->title }}
            </div>
        </div>
        <div>
            <div class="p-3">
                <img class="object-cover mx-auto w-60 h-72 sm:h-40 sm:w-32" src="{{ $resourceful->cover_page_url }}" alt="{{ $resource->title }}" />
            </div>
            <div class="p-3 text-sm font-semibold text-blue-700 bg-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-1 mr-4">
                        <i class="mr-2 text-lg fas fa-file-pdf"></i> PDF document
                    </div>
                    <div class="flex-shrink-0 text-sm font-medium text-gray-700">
                        {{ $resourceful->created_at->diffForHumans() }}
                    </div>
                </div>
                @if($resourceful->specific_pages)
                <div class="pt-3 text-blue-700">
                    @if($resourceful->specific_pages['start_page'])
                    <a class="underline" href="{{ route('resource.view', ['resource' => $resource, 'type' => 'document']) }}#page={{ $resourceful->specific_pages['start_page'] }}">Page
                        {{ $resourceful->specific_pages['start_page'] }}</a>
                    @endif
                    @if($resourceful->specific_pages['end_page'])
                    - <a class="underline" href="{{ route('resource.view', ['resource' => $resource, 'type' => 'document']) }}#page={{ $resourceful->specific_pages['end_page'] }}">Page
                        {{ $resourceful->specific_pages['end_page'] }}</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </a>
    @break

    @case('App\Models\PersonalNote')
    <a class="block" href="{{ route('resource.view', ['resource' => $resource, 'type' => 'personal-note']) }}">
        <div>
            <div class="p-3 border-b border-gray-400">
                <div class="flex justify-between gap-3 font-semibold text-blue-700 text-md">
                    <span>
                        {{ $resource->title ?? __('Untitled note') }}
                    </span>
                    <i class="fas fa-map-pin"></i>
                </div>
            </div>
            <p class="px-3 pb-3 break-words truncate whitespace-pre-line cursor-pointer line-clamp-4">{{ $resourceful->content }}</p>
            <div class="flex items-center justify-between p-3 font-semibold text-blue-700 bg-white text-md">
                <div class="flex items-center flex-1 mr-4">
                    <i class="mr-2 text-lg fas fa-sticky-note"></i> Sticky Note
                </div>
                <div class="flex-shrink-0 text-sm font-medium text-gray-700">
                    {{ $resourceful->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </a>
    @break

    @case('App\Models\ResourceLink')
    <div>
        <div class="p-3 border-b border-gray-400">
            <div class="font-semibold text-blue-700 text-md">
                {{ $resource->title }}
            </div>
        </div>
        <p class="p-3 break-words">
            <a class="text-blue-700" href="{{ $resourceful->url }}">{{ $resourceful->url }}</a>
        </p>
        <div class="flex items-center justify-between p-3 text-sm font-semibold text-blue-700 bg-white">
            <div class="flex items-center flex-1 mr-4">
                <i class="mr-2 text-lg fas fa-link"></i> Link
            </div>
            <div class="flex-shrink-0 text-sm font-medium text-gray-700">
                {{ $resourceful->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    @break
    @endswitch
</div>
@endif
